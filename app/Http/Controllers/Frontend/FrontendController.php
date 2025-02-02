<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Course;
use App\Models\HomePageSettings;
use App\Models\Order;
use App\Models\Testimonial;
use App\Models\Trainer;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function homepage()
    {
        $home=HomePageSettings::first();
        $course=Course::with('trainer','category')->get();
        $trainer=Trainer::query()->get();       
        return view('frontend.home',compact('home','course','trainer'));
    }

    public function aboutus()
    {
        $about=About::query()->first();
        $testimonial=Testimonial::query()->get();
        return view('frontend.about_us',compact('testimonial','about'));
    }

    public function course()
    {
        $course=Course::with('category','trainer')->get();
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
          
        return redirect()->route('homepage');
    }
}
