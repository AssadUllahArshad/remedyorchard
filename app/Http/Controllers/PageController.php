<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function privacy()
    {
        return view('legal.privacy');
    }

    public function terms()
    {
        return view('legal.terms');
    }

    public function cookiePolicy()
    {
        return view('legal.cookie-policy');
    }

    public function medicalDisclaimer()
    {
        return view('legal.medical-disclaimer');
    }

    public function advertise()
    {
        return view('legal.advertise');
    }
}
