<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Post;

class PostModelTest extends TestCase
{
    /**
     * Unit test for model.
     */
    public function test_create_model(): void
    {
        $record = Post::factory()->create();
        $this->assertDatabaseHas('posts', [
            'id' => $record->id,
        ]);
    }
}
