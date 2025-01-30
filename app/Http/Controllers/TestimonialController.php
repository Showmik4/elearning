<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Traits\FileTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TestimonialController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function show()
    {
        return view('testimonial.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $testimonial = Testimonial::all();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($testimonial)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })  
            ->addColumn('image', function (Testimonial $testimonial){
                if (isset($testimonial->image)) {
                    return '<img height="50px" width="50px" src="'.url($testimonial->image).'" alt="">';
                }
                return '';
            })        
            ->setRowAttr([
                'align' => 'center',
            ])            
            ->rawColumns(['image'])     
            ->make(true);
    }

    public function create()
    {        
        return view('testimonial.create');
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255', 
            'job'=>'required', 
            'review'=>'required', 
            'description'=>'required',
            'image'=>'required',      
        ]);

        $testimonial = Testimonial::create([
            'name' => $validated['name'], 
            'job'=>$validated['job'],     
            'review'=>$validated['review'],  
            'description'=>$validated['description'], 
            'image' => $this->save_image('testimonialImage', $validated['image']),
        ]);         
           
        Session::flash('success', 'Testimonial Created Successfully!');
        return redirect()->route('testimonial.show');
    }

    public function edit($id)
    {      
        $testimonial = Testimonial::findOrFail($id);  
        
        return view('testimonial.edit', compact('testimonial'));
    }

    public function update(Request $request, $id): RedirectResponse
    {       
        $validated = $request->validate([
            'name' => 'nullable|string|max:255', 
            'job'=>'nullable', 
            'review'=>'nullable', 
            'description'=>'nullable',
            'image'=>'nullable',     
        ]);
       
        $testimonial = Testimonial::findOrFail($id);       
        if (!empty($testimonial)) {
            $image = $testimonial->image;           
            if ($request->hasFile('image')) {
                $this->deleteImage($testimonial->image); 
                $image = $this->save_image('testimonialImage', $request->file('image')); 
            }
           
            $testimonial->update([
                'name' => $validated['name'], 
                'job'=>$validated['job'],     
                'review'=>$validated['review'],  
                'description'=>$validated['description'], 
                'image' => $image,               
            ]);
            
            Session::flash('success', 'Testimonial Updated Successfully!');
        }
      
        return redirect()->route('testimonial.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $testimonial = Testimonial::where('id', $request->id)->first();
        if (!empty($trainer)) {          
            $testimonial->delete();
        }
        return response()->json();
    }
}
