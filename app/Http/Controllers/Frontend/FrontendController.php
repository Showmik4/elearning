<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function homepage()
    {
        return view('frontend.home');
    }

    public function aboutus()
    {
        return view('frontend.about_us');
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
}
