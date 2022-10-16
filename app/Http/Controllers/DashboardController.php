<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $posts = \App\Models\Post::all();
        return view('dashboard')->with(['posts' => $posts]);
    }
}
