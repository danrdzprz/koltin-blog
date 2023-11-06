<?php

namespace Tests\Unit;

use App\Models\Post;
use Tests\TestCase;

class CleanUpTextPostTest extends TestCase
{
    /**
     * Test to verify if the muttator method to clean up the text attribute in model works.
     */
    public function testCleanUpTextPostModel(): void
    {
        $harmful_text = '<script>alert("Harmful Script");</script> <p style="border:1px solid black" class="text-gray-700">Text test</p>';
        $record = Post::factory()->create(
            [
                'text' => $harmful_text,
            ]
        );

        $text_cleaned_up = '<p>Text test</p>';
        $this->assertDatabaseHas('posts', [
            'id' => $record->id,
        ]);

        $this->assertSame($text_cleaned_up, $record->text);
    }
}
