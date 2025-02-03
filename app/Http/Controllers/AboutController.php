<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\CourseMaterial;
use App\Traits\FileTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function show()
    {
        return view('about.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $about = About::all();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($about)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })  
            ->addColumn('image', function (About $about){
                if (isset($about->image)) {
                    return '<img height="50px" width="50px" src="'.url($about->image).'" alt="">';
                }
                return '';
            })        
            ->setRowAttr([
                'align' => 'center',
            ])            
            ->rawColumns(['image'])     
            ->make(true);
    }

       public function edit($id)
    {      
        $about = About::findOrFail($id);  
        
        return view('about.edit', compact('about'));
    }

    public function update(Request $request, $id): RedirectResponse
    {  
             
        $validated = $request->validate([
            'banner_description' => 'required', 
            'about_description'=>'required', 
            'image'=>'nullable',     
        ]);
       
        $about = About::findOrFail($id);   
        
        if (!empty($about)) {
            $image = $about->image;  
            // dd($image);        
            if ($request->hasFile('image')) {
                $this->deleteImage($about->image); 
                $image = $this->save_image('aboutImage', $request->file('image')); 
            }
           
            $about->update([
                'banner_description' => $validated['banner_description'], 
                'about_description'=>$validated['about_description'],     
                'image' => $image,               
            ]);
            
            Session::flash('success', 'About Updated Successfully!');
        }
      
        return redirect()->route('about.show');
    }

  

  
}
