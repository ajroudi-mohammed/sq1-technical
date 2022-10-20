<?php

namespace App\Http\Repositories;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostRepository {

    public function getAllPosts(){
        return Post::with('user:id,name')
                //->whereBetween('publishedAt', [Carbon::now()->subDays(30), Carbon::now()])
                ->orderBy('publishedAt', 'desc')
                ->paginate(20);
    }

    //TODO: use Redis driver
    public function getCurrentUserPosts($order = ''){

        $posts = Post::where('user_id', Auth::id());
        if( $order )
            $posts = $posts->orderBy('publishedAt', $order);
        return $posts->paginate(10);

    }

    public function createPost($attributes){
        $attributes['user_id'] = Auth::id();
        return Post::create($attributes);
    }

}
