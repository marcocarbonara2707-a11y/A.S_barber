<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
   public function index()
{
    $haircuts = \App\Models\Haircut::where('approved', true)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('home', compact('haircuts'));
}
}