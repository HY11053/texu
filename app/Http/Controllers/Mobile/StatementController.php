<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatementController extends Controller
{
    //
    public function about()
    {
        return view('frontend.about');
    }
    public function law()
    {
        return view('frontend.law');
    }
    public function map()
    {
        return view('frontend.map');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
}
