<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(PostRepository $postRepository){

        $posts = $postRepository->getCurrentUserPosts();
        return view('dashboard')->with(['posts' => $posts]);
    }
}
