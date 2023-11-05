<?php

namespace Tests\Unit;

use App\Models\Comment;
use Tests\TestCase;

class CommentModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testExample(): void
    {
        $record = Comment::factory()->create();
        $this->assertDatabaseHas('comments', [
            'id' => $record->id,
        ]);
    }
}
