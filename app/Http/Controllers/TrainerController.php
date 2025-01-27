<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Session;

class TrainerController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function show()
    {
        return view('trainer.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $trainer = Trainer::all();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($trainer)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })  
            ->addColumn('image', function (Trainer $trainer){
                if (isset($trainer->image)) {
                    return '<img height="50px" width="50px" src="'.url($trainer->image).'" alt="">';
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
        return view('trainer.create');
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255', 
            'field'=>'required',  
            'description'=>'required',
            'image'=>'required',      
        ]);

        $trainer = Trainer::create([
            'name' => $validated['name'], 
            'field'=>$validated['field'],     
            'description'=>$validated['description'], 
            'image' => $this->save_image('trainerImage', $validated['image']),
        ]);         
           
        Session::flash('success', 'Trainer Created Successfully!');
        return redirect()->route('trainer.show');
    }

    public function edit($id)
    {      
        $trainer = Trainer::findOrFail($id);  
        
        return view('trainer.edit', compact('trainer'));
    }

    public function update(Request $request, $id): RedirectResponse
    {       
        $validated = $request->validate([
            'name' => 'required|string|max:255', 
            'field'=>'required',  
            'description'=>'required',
            'image'=>'nullable',     
        ]);
       
        $trainer = Trainer::findOrFail($id);       
        if (!empty($trainer)) {
            $image = $trainer->image;           
            if ($request->hasFile('image')) {
                $this->deleteImage($trainer->image); 
                $image = $this->save_image('trainerImage', $request->file('image')); 
            }
           
            $trainer->update([
                'name' => $validated['name'], 
                'field'=>$validated['field'],     
                'description'=>$validated['description'], 
                'image' => $image,               
            ]);
            
            Session::flash('success', 'Trainer Updated Successfully!');
        }
      
        return redirect()->route('trainer.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $trainer = Trainer::where('id', $request->id)->first();
        if (!empty($trainer)) {          
            $trainer->delete();
        }
        return response()->json();
    }
}
