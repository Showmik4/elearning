<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMaterial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\FileTrait;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Session;

class CourseMaterialController extends Controller
{   
    use ImageTrait;
    use FileTrait; 

    public function list(Request $request)
    {
        $course_material = CourseMaterial::with('course')->where('course_id',$request->course_id)->get();      
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray();
        return datatables()->of($course_material)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })
            ->addColumn('course', function (CourseMaterial $course_material) {
                return $course_material->course->title;
            })
         
            ->addColumn('Downloads', function (CourseMaterial $course_material) {
                $documentLinks = '';      
                
                $fileNameArray = explode('/', $course_material->file);
                $documentFileName = end($fileNameArray);       
                  
                $documentLinks .= '<a href="' . asset($course_material->file) . '" target="_blank" class="file-download" download="' . $documentFileName . '" title="Download Document">
                                            <i class="fa fa-download font-24"></i>
                                       </a><br>';              
            
                return $documentLinks ?: 'No Documents'; 
            })

            ->setRowAttr([
                'align' => 'center',
            ])  
           
            ->rawColumns(['Downloads'])  
            ->make(true);
    }
    public function create($id)
    {      
        $course=Course::find($id);       
        return view('course_material.create',compact('course'));
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'course_id' => 'required', 
            'file'=>'required',  
            'status'=>'required', 
            'description'=>'required',       
        ]);

        $course_material = CourseMaterial::create([
            'course_id' => $validated['course_id'], 
            'status'=>$validated['status'],   
            'description'=>$validated['description'],  
            'file' => $this->save_image('courseMaterialImage', $validated['file']),         
        ]);         
           
        Session::flash('success', 'Course Material Created Successfully!');
        return redirect()->back();
    }

    public function edit($id)
    {      
        $course_material = CourseMaterial::with('course')->findOrFail($id);  
      
        return view('course_material.edit', compact('course_material'));
    }

    public function update(Request $request, $id): RedirectResponse
    {       
        $validated = $request->validate([          
            'file'=>'nullable',  
            'status'=>'nullable', 
            'description'=>'nullable', 
        ]);
       
        $course_material = CourseMaterial::findOrFail($id);       
        if (!empty($course_material)) { 
            $image = $course_material->file;           
            if ($request->hasFile('file')) {
                $this->deleteImage($course_material->image); 
                $image = $this->save_image('courseMaterialImage', $request->file('file')); 
            }
           
            $course_material->update([               
                'status'=>$validated['status'],   
                'description'=>$validated['description'],   
                'file' => $image,               
            ]);
            
            Session::flash('success', 'Course Material Updated Successfully!');
        }
      
        return redirect()->route('course.show');
    }

}
