<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ApiPostControllerTest extends TestCase
{
    /**
     * Test endpoint to get list of post paginated.
     */
    public function testExample(): void
    {
        $user = User::factory()->create();
        $url = '/api/posts';
        $this->actingAs($user, 'sanctum');

        $post = Post::factory()->create();

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
        ]);

        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'text',
                    'user',
                    'comments',
                ],
                ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);
    }
}
