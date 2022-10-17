<?php

namespace App\Console\Commands;

use App\Models\Post;
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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get($this->api_url);
        if( $response->successful() ){
            $posts = $response->json();
            if( isset($posts['articles']) && count($posts['articles']) > 0 ){
                $postsCollection = collect($posts['articles']);
                $imported_posts_ids = Cache::get('imported_posts_cache_ids');
                if( !$imported_posts_ids ){
                    $imported_posts_ids = Cache::rememberForever('imported_posts_cache_ids', function () use ($postsCollection) {
                        return $postsCollection->pluck('id');
                    });
                    //insert all api posts into db
                }
                $api_posts_ids = $postsCollection->pluck('id');

                $diff = $api_posts_ids->diff($imported_posts_ids);

                if( $diff->all() ){
                    //insert the diff into db
                    //update cache
                    dd($diff->all());
                }
            }
        }
        return Command::SUCCESS;
    }
}
