<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleConttroller extends Controller
{
    public function homepage(){
        $ourName = 'Tyresz';
        $animals = ['Meow', 'Doggy', 'Chirp' ];
        return view('homepage', ['name' => $ourName, 'allAnimals'=>$animals]);
    }

    public function aboutPage(){
        return view('single-post');
    }
}
