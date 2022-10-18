<?php

namespace App\Http\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostRepository {

    public function getAllPosts(){
        return Post::paginate(10);
    }

    //TODO: Fix cache with pagination
    //TODO: use Redis driver
    public function getCurrentUserPosts($type = ''){
        return Cache::remember('cached_posts', 10, function () use ($type) {
            $posts = Post::where('user_id', Auth::id());
            if( $type )
                $posts = $posts->orderBy('publishedAt', $type);
            return $posts->paginate(10);
        });
    }

    public function createPost($attributes){
        $attributes['user_id'] = Auth::id();
        return Post::create($attributes);
    }
}
