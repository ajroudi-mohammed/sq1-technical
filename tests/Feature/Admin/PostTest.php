<?php

namespace Tests\Feature\Admin;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{

    use RefreshDatabase;

    public function testCreate()
    {
        $this->actingAsUser()
            ->get('/posts/create')
            ->assertOk()
            ->assertSee('Create post')
            ->assertSee('Title')
            ->assertSee('Description')
            ->assertSee('Create');
    }

    public function testStore()
    {
        $params = $this->validParams();

        //dd($params);
        $this->actingAsUser()
            ->post('/posts', $params)
            ->assertStatus(302);

        $this->assertDatabaseHas('posts', $params);
    }

    public function testStoreFail()
    {
        $params = $this->validParams(['description' => null]);

        $this->actingAsUser()
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
    }

    public function validParams($overrides = []){
        return array_merge([
            'title' => 'hello world',
            'description' => 'This is a description',
            'publishedAt' => now()->format('Y-m-d\TH:i'),
            'user_id' => 1,
        ], $overrides);
    }
}
