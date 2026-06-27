<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        return view('home'); // resources/views/home.blade.php
    }

    public function infos() {
        return view('infos');
    }

    public function contact() {
        return view('contact');
    }

    public function nouveautes() {
        return view('nouveautes');
    }

    public function tarifs() {
        return view('tarifs');
    }

    public function cgu() {
        return view('cgu');
    }
}
