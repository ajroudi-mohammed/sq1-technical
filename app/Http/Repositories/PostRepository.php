<?php

namespace App\Http\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostRepository {

    public $post_cache_duration;

    public function __construct(){
        $this->post_cache_duration = config('cache.cache_post_duration');
    }

    public function getAllPosts(){
        return Cache::remember('cached_posts', $this->post_cache_duration, function () {
            return Post::paginate(10);
        });
    }

    //TODO: use Redis driver
    public function getCurrentUserPosts($type = ''){
        return Cache::remember('cached_posts', $this->post_cache_duration, function () use ($type) {
            $posts = Post::where('user_id', Auth::id());
            if( $type )
                $posts = $posts->orderBy('publishedAt', $type);
            return $posts->paginate(10);
        });
    }

    public function createPost($attributes){
        $attributes['user_id'] = Auth::id();
        Cache::forget('cached_posts');
        return Post::create($attributes);
    }
}
