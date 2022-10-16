<?php

namespace App\Http\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository {

    public function getAllPosts(){
        return Post::all();
    }

    public function getCurrentUserPosts(){
        return Post::where('user_id', Auth::id())
                    ->get();
    }

    public function createPost($attributes){
        $attributes['user_id'] = Auth::id();
        return Post::create($attributes);
    }
}
