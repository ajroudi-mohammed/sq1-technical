<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PostImportCommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_import_command()
    {
        User::factory()->create();

        Http::fake([
            config('app.post_api_url') => Http::response($this->apiResponse(), 200)
        ]);

        $this->artisan('import-posts:halfhourly')->assertExitCode(0);
    }

    public function test_articles_key_not_found_from_api_response()
    {
        User::factory()->create();

        $response = $this->apiResponse();

        unset($response['articles']);

        Http::fake([
            config('app.post_api_url') => Http::response($response, 200)
        ]);

        $this->artisan('import-posts:halfhourly')->assertExitCode(1);
    }

    public function apiResponse($overrides = []){
        return array_merge([
            "status" => "ok",
            "count" => 1,
            "articles" => [
                [
                    "id" => 1,
                    "title" => "Car Companies Are Making a Deadly Mistake With Electric Vehicles",
                    "description" => "It’s not too late for the U.S. to do something about it.",
                    "publishedAt" => "2022-08-31T09:45:01Z"
                ]
            ]
        ], $overrides);
    }

}
