<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request){
       $questions=["aaa","bbbbb"];
      return view('welcome',compact('questions'));
    }
}
