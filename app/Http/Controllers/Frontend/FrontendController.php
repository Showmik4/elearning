<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Contact;
use App\Models\Course;
use App\Models\HomePageSettings;
use App\Models\Order;
use App\Models\Testimonial;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendController extends Controller
{
    public function homepage()
    {
        $home=HomePageSettings::first();
        $course=Course::with('trainer','category')->get();
        $trainer=Trainer::query()->get();  
        $totalCourse=Course::count();    
        $totalStudent=User::where('fkUserTypeId',2)->count(); 
        $totalTrainer=Course::count();  
        return view('frontend.home',compact('home','course','trainer','totalCourse','totalStudent','totalTrainer'));
    }

    public function aboutus()
    {
        $about=About::query()->first();
        $testimonial=Testimonial::query()->get();
        $totalCourse=Course::count();    
        $totalStudent=User::where('fkUserTypeId',2)->count(); 
        $totalTrainer=Course::count();  
        return view('frontend.about_us',compact('testimonial','about','totalCourse','totalStudent','totalTrainer'));
    }

    public function course()
    {
        $course=Course::with('category','trainer')->get();
        // dd($course);
        return view('frontend.course',compact('course'));
    }

    public function course_details($id)
    {
        $course=Course::with('trainer')->find($id)->first();
        return view('frontend.course_details',compact('course'));
    }

    public function contact()
    {

        return view('frontend.contact');
    }

    public function trainer()
    {
        $trainer=Trainer::query()->get();
        return view('frontend.trainer',compact('trainer'));
    }

    public function checkout($id)
    {         
        $course=Course::where('id',$id)->first();      
        return view('frontend.checkout',compact('course'));
    }

    public function submit_order(Request $request)
    {
        $validated = $request->validate([
            'note' => 'nullable', 
            'user_id'=>'required', 
            'course_id'=>'nullable',   
            'payment_method'=>'required',  
            'total_price'=>'required', 
        ]);
       
        $order = Order::create([
            'note' => $validated['note'], 
            'user_id' => $validated['user_id'],  
            'course_id' => $validated['course_id'],    
            'payment_method' => $validated['payment_method'],  
            'total_price' => $validated['total_price'],     
        ]);   
        Session::flash('success', 'Order Placed Successful!');
        return redirect()->route('homepage');
    }

    public function submit_contact(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'nullable', 
            'email'=>'required', 
            'subject'=>'nullable',   
            'message'=>'required', 
           
        ]);
       
        $contact = Contact::create([
            'name' => $validated['name'], 
            'email' => $validated['email'],  
            'subject' => $validated['subject'],    
            'message' => $validated['message'], 
              
        ]);   

        Session::flash('success', 'Message Sending Successful!');
          
        return redirect()->back();
    }
}
