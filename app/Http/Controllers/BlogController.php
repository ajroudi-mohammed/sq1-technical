<?php

namespace App\Http\Controllers;

use App\Http\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
    //
    public function index(PostRepository $postRepository){

        //clear_cache();

        $cacheDuration = config('cache.cache_post_duration');

        $currentPage = request()->get('page',1);

        $cachedView = Cache::remember('articles_index_' . $currentPage, $cacheDuration, function() use($postRepository){
            $posts = $postRepository->getAllPosts();
            //dd('gere');
            return view('blog')->with('posts', $posts)->render();
        });


        return $cachedView;
    }
}
