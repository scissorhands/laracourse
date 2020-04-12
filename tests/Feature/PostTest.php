<?php

namespace Tests\Feature;

use App\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/posts');

        $response->assertSeeText("No posts");
    }

    public function testSee1BlogPostWhenThereIs1(){
        $title = "Test title";
        $post = BlogPost::create([
            'title' => $title,
            'content' => 'content test'
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText($title);
        $this->assertDatabaseHas('blog_posts', [
            'title' => $title
        ]);
    }

    public function testStoreValid (){
        $params = [
            'title' => 'My title',
            'content' => 'My content'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post created');
    }
}
