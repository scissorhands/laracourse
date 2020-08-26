<?php

namespace Tests\Feature;

use App\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Comment;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testSeeNoPosts()
    {
        $response = $this->get('/posts');

        $response->assertSeeText("No posts");
    }

    public function testSee1BlogPostWhenThereIs1(){
        $title = "Test title";
        $user = $this->user();
        $post = BlogPost::create([
            'title' => $title,
            'content' => 'content test',
            'user_id' => $user->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText($title);
        $this->assertDatabaseHas('blog_posts', [
            'title' => $title
        ]);
    }

    public function testSee1BlogPostWithComments()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost();
        factory(Comment::class, 4)->create([
            'commentable_id'=>$post->id,
            'commentable_type' => 'App\BlogPost',
            'user_id' => $user->id
        ]);
        $response = $this->get('/posts');
        $response->assertSeeText("4 comments");
    }

    public function testStoreValid (){
        $params = [
            'title' => 'My title',
            'content' => 'My content'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post created');
    }

    public function testStoreFail(){
        $params = [
            'title' => '',
            'content' => ''
        ];

         $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');
        $messages = session('errors')->getMessages();
        $this->assertEquals($messages['title'][0], 'The title field is required.');
        $this->assertEquals($messages['content'][0], 'The content field is required.');

    }

    public function testUpdatePost(){
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);
        $original_post = [
            'title' => $post->title,
            'content' => $post->content
        ];
        $this->assertDatabaseHas('blog_posts', $original_post);

        $updated_params = [
            'title' => 'Test title updated',
            'content' => 'test content updated'
        ];
         $this->actingAs($user)
            ->put("/posts/{$post->id}", $updated_params)
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post was updated');
        $this->assertDatabaseMissing('blog_posts', $original_post);
    }

    public function testDeletePost(){
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);
        $original_post = [
            'title' => $post->title,
            'content' => $post->content
        ];
        $this->assertDatabaseHas('blog_posts', $original_post);

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
        $this->assertEquals(session('status'), 'Blog Post was deleted');
        $this->assertSoftDeleted('blog_posts', $original_post);
    }

    private function createDummyBlogPost($userId = null): BlogPost {
        return factory(BlogPost::class)->states('new-title')->create([
            'user_id' => $userId ?? $this->user()->id,
        ]);
    }
}
