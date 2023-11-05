<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class PostModelTest extends TestCase
{
    /**
     * Unit test for model.
     */
    public function testPostModel(): void
    {
        $record = Post::factory()->create();
        $this->assertDatabaseHas('posts', [
            'id' => $record->id,
        ]);
    }
}
