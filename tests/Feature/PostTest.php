<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_page_is_accessible()
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create([
            'category_id' => $category->id,
            'slug' => 'test-post-slug',
            'is_published' => true,
        ]);

        $response = $this->get('/posts/test-post-slug');

        $response->assertStatus(200);
    }
}
