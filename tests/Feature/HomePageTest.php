<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_can_render_the_homepage()
    {

        $user = User::factory()->create();

        $post = Post::factory()->create(['user_id' => $user->id]);

        $this->get('/')
            ->assertOk()
            ->assertSee('SQ1 Technical Test')
            ->assertSee($post->title);


    }
}
