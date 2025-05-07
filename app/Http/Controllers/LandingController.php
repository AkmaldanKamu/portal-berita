<?php

namespace App\Http\Controllers;

use App\Models\Benner;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    
    public function index()
    {
        $benners = Benner::all();
        return view('pages.landing' , compact ('benners'));
    }
}
