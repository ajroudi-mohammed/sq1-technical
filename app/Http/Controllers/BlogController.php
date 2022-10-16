<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index(PostRepository $postRepository){
        $posts = $postRepository->getAllPosts();
        return view('blog')->with(['posts' => $posts]);
    }
}
