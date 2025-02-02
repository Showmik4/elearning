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

    public function list()
    {
        $course_material = CourseMaterial::with('course')->get();      
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
        ]);

        $course_material = CourseMaterial::create([
            'course_id' => $validated['course_id'], 
            'status'=>$validated['status'],    
            'file' => $this->save_image('courseMaterialImage', $validated['file']),         
        ]);         
           
        Session::flash('success', 'Course Material Created Successfully!');
        return redirect()->back();
    }

}
