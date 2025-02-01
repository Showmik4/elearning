<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Course;
use App\Models\HomePageSettings;
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
        // dd($home);
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
        return view('frontend.course');
    }

    public function course_details()
    {
        return view('frontend.course_details');
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
}
