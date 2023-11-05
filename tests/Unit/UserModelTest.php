<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    /**
     * Unit test for model.
     */
    public function testUserModel(): void
    {
        $record = User::factory()->create();
        $this->assertDatabaseHas('users', [
            'id' => $record->id,
        ]);
    }
}
