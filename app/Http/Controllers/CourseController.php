<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Trainer;
use App\Traits\FileTrait;
use App\Traits\ImageTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    use ImageTrait;
    use FileTrait;
    public function show()
    {
        return view('course.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        $course = Course::with('category','trainer')->get();     
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($course)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            })  
            ->addColumn('image', function (Course $course){
                if (isset($course->image)) {
                    return '<img height="50px" width="50px" src="'.url($course->image).'" alt="">';
                }
                return '';
            })   
            ->addColumn('category', function (Course $course){                
                return $course->category->name;
            }) 
            ->addColumn('trainer', function (Course $course){                
                return $course->trainer->name;
            })  
            ->addColumn('image', function (Course $course){
                if (isset($course->image)) {
                    return '<img height="50px" width="50px" src="'.url($course->image).'" alt="">';
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
        $trainer=Trainer::all();
        $category=Category::all();  
        return view('course.create',compact('trainer','category'));
    }

    public function store(Request $request): RedirectResponse
    {       
        $validated = $this->validate($request, [
            'title' => 'required|string|max:255', 
            'short_details'=>'required',  
            'long_details'=>'required', 
            'category_id'=>'required',
            'trainer_id'=>'required',
            'total_seat'=>'required',
            'schedule'=>'required',
            'details_page_banner_description'=>'required',
            'image'=>'required',  
            'detail_page_image'=>'required',  
            'price'=>'required',  
        ]);

        $course = Course::create([
            'title' => $validated['title'], 
            'short_details'=>$validated['short_details'],     
            'long_details'=>$validated['long_details'], 
            'category_id'=>$validated['category_id'], 
            'trainer_id'=>$validated['trainer_id'], 
            'total_seat'=>$validated['total_seat'], 
            'schedule'=>$validated['schedule'], 
            'price'=>$validated['price'], 
            'details_page_banner_description'=>$validated['details_page_banner_description'], 
            'image' => $this->save_image('courseImage', $validated['image']),
            'detail_page_image' => $this->save_image('courseImage', $validated['detail_page_image']),
        ]);         
           
        Session::flash('success', 'Course Created Successfully!');
        return redirect()->route('course.show');
    }

    public function edit($id)
    {      
        $course = Course::findOrFail($id);  
        $trainer=Trainer::all();
        $category=Category::all();
        return view('course.edit', compact('trainer','category','course'));
    }

    public function update(Request $request, $id): RedirectResponse
    {       
        $validated = $request->validate([
            'title' => 'nullable|string|max:255', 
            'short_details'=>'nullable',  
            'long_details'=>'nullable', 
            'category_id'=>'nullable',
            'trainer_id'=>'nullable',
            'total_seat'=>'nullable',
            'schedule'=>'nullable',
            'details_page_banner_description'=>'nullable',
            'image'=>'nullable',  
            'detail_page_image'=>'nullable',   
            'price'=>'nullable',    
        ]);
       
        $course = Course::findOrFail($id);       
        if (!empty($course)) {
            $image = $course->image;           
            if ($request->hasFile('image')) {
                $this->deleteImage($course->image); 
                $image = $this->save_image('courseImage', $request->file('image')); 
            }

            $detail_image = $course->detail_page_image;           
            if ($request->hasFile('detail_page_image')) {
                $this->deleteImage($course->detail_page_image); 
                $detail_image = $this->save_image('courseImage', $request->file('detail_page_image')); 
            }
           
            $course->update([
                'title' => $validated['title'], 
                'price' => $validated['price'], 
                'short_details'=>$validated['short_details'],     
                'long_details'=>$validated['long_details'], 
                'category_id'=>$validated['category_id'], 
                'trainer_id'=>$validated['trainer_id'], 
                'total_seat'=>$validated['total_seat'], 
                'schedule'=>$validated['schedule'], 
                'details_page_banner_description'=>$validated['details_page_banner_description'], 
                'image' => $image,
                'detail_page_image' => $detail_image,          
            ]);
            
            Session::flash('success', 'Course Updated Successfully!');
        }
      
        return redirect()->route('course.show');
    }

    public function delete(Request $request): JsonResponse
    {
        $course = Course::where('id', $request->id)->first();
        if (!empty($course)) {          
            $course->delete();
        }
        return response()->json();
    }
}
