<?php

namespace App\Http\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostRepository {

    public function getAllPosts(){
        return Post::paginate(10);
    }

    public function getCurrentUserPosts($type = ''){
        $posts = Post::where('user_id', Auth::id());
        if( $type )
            $posts = $posts->orderBy('publishdate_at', $type);
        return $posts->paginate(10);
    }

    public function createPost($attributes){
        $attributes['user_id'] = Auth::id();
        return Post::create($attributes);
    }
}
