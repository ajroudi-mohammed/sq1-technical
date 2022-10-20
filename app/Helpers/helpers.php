<?php

use Illuminate\Support\Facades\Cache;

function clear_posts_cache(){
    $keys = Cache::get('keys');
    if( is_array($keys) && count($keys) > 0){
        foreach ($keys as $key) {
            Cache::forget($key);
        }
        Cache::forget('keys');
    }
}
