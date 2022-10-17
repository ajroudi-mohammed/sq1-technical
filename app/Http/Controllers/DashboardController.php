<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(PostRepository $postRepository){

        $orderBy = request('orderBy') === 'asc' ? 'asc' : 'desc';
        $posts = $postRepository->getCurrentUserPosts($orderBy);
        return view('dashboard')->with(['posts' => $posts]);
    }
}
