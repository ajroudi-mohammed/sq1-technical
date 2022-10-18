<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PostImportCommand extends Command
{
    /**
     * SQ1 endpoint
     */
    protected $API_URL;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-posts:hourly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts hourly';


    public function __construct()
    {
        parent::__construct();
        $this->api_url = env('API_URL', 'https://candidate-test.sq1.io/api.php');
    }

    /**
     * Formats and saves posts into DB
     */
    public function formatAndSavePosts($postsFromApi){
        $newPostCol = $postsFromApi->map(function( $arr ){

            $arr['publishedAt'] = Carbon::parse($arr['publishedAt']);
            $arr['user_id'] = 1;
            $arr['imported_post_id'] = $arr['id'];
            unset($arr['id']);
            return $arr;

        });

        return Post::insert($newPostCol->toArray());
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Cache::forget('imported_posts_cache_ids');

        $response = Http::get($this->api_url);
        if( $response->successful() ){

            $posts = $response->json();
            if( isset($posts['articles']) && count($posts['articles']) > 0 ){
                $postsCollection = collect($posts['articles']);
                $imported_posts_ids = Cache::get('imported_posts_cache_ids');

                //the first insert
                if( !$imported_posts_ids ){
                    if( $this->formatAndSavePosts($postsCollection) )
                        $imported_posts_ids = Cache::rememberForever('imported_posts_cache_ids', function () use ($postsCollection) {
                            return $postsCollection->pluck('id');
                        });
                }



                //get posts that don't exist in DB
                $api_posts_ids = $postsCollection->pluck('id');
                $diff = $api_posts_ids->diff($imported_posts_ids);

                if( $diff->isNotEmpty() ){
                    //Mass insert
                    $diffPosts = $diff->map(function($item) use($postsCollection){
                        $post = collect($postsCollection->where( 'id' , '=', $item)->first());
                        $arr['id'] = $item;
                        $arr['title'] = $post->get('title');
                        $arr['description'] = $post->get('description');
                        $arr['publishedAt'] = Carbon::parse($post->get('publishedAt'));
                        $arr['user_id'] = 1;
                        $arr['imported_post_id'] = $post->get('id');
                        return $arr;
                    });

                    Post::insert($diffPosts->toArray());

                    //Update cache
                    $mergedIds = $imported_posts_ids->merge($diff);
                    Cache::put('imported_posts_cache_ids', $mergedIds);
                }
            }
        }
        return Command::SUCCESS;
    }
}
