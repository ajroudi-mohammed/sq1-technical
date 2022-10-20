<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CacheKeysMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if( request()->routeIs('home') ){
            $currentPage = request()->get('page',1);

            $cachedkeys = Cache::rememberForever('keys', function() use ($currentPage){
                //dd('cache middleware hit !');
                $keys[] = 'articles_index_' . $currentPage;
                return $keys ;
            });

            $needle = 'articles_index_' . $currentPage;

            if( !in_array($needle, $cachedkeys ) ){

                $cachedkeys[] = $needle;
                Cache::put('keys', $cachedkeys);

            }


        }

        return $next($request);
    }
}
