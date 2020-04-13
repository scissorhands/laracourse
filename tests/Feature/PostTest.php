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

    public function testStoreFail(){
        $params = [
            'title' => '',
            'content' => ''
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title field is required.');
        $this->assertEquals($messages['content'][0], 'The content field is required.');

    }

    public function testUpdatePost(){
        $post = $this->createDummyBlogPost();
        $original_post = [
            'title' => $post->title,
            'content' => $post->content
        ];
        $this->assertDatabaseHas('blog_posts', $original_post);

        $updated_params = [
            'title' => 'Test title updated',
            'content' => 'test content updated'
        ];
        $this->put("/posts/{$post->id}", $updated_params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post was updated');
        $this->assertDatabaseMissing('blog_posts', $original_post);
    }

    public function testDeletePost(){
        $post = $this->createDummyBlogPost();
        $original_post = [
            'title' => $post->title,
            'content' => $post->content
        ];
        $this->assertDatabaseHas('blog_posts', $original_post);

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post was deleted');
        $this->assertDatabaseMissing('blog_posts', $original_post);
    }

    private function createDummyBlogPost(): BlogPost {
        return BlogPost::create([
            'title' => 'Test title',
            'content' => 'test content'
        ]);
    }
}
