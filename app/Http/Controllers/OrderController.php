<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseMaterial;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show()
    {
        return view('order.index');
    }

    /***
     * @throws Exception
     **/
    public function list()
    {
        if(auth()->user()->userType->typeName == 'Admin')
        {
            $order = Order::with('user','course')->get();   
        }
        else
        {
            $order = Order::with('user','course')->where('user_id',auth()->user()->userId)->get();
        }
          
        $userPermissions = auth()->user()->userType->permissions->pluck('name')->toArray(); 
        return datatables()->of($order)
            ->addColumn('permissions', function () use ($userPermissions) {
                return $userPermissions; 
            }) 

            ->addColumn('course', function (Order $order) {
                return $order->course->title;
            })

            ->addColumn('user', function (Order $order) {
                return $order->user->firstName;
            })
                 
            ->setRowAttr([
                'align' => 'center',
            ])            
               
            ->make(true);
    }

  
    public function course_details($id)
    {      
        $course=Course::find($id);
           
        return view('order.course_details', compact('course'));
    }

    public function course_detailsList(Request $request)
    {
        $course_material = CourseMaterial::with('course')->where('course_id',$request->course_id)->where('status','Active')->get();   
        // dd($course_material);  
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
}
