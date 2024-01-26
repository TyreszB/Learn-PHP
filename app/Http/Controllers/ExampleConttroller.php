<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleConttroller extends Controller
{
    public function homepage(){
        return '<h1>home Page</h1><a href= "/about-us" >view about page!!!</a>';
    }

    public function aboutPage(){
        return '<h1>About PAge</h1><a href= "/" >Back to home!!!</a>';
    }
}
