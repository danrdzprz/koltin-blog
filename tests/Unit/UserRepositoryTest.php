<?php

namespace Tests\Unit;

use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    /**
     * Get all users paginated.
     */
    public function testGetAllUsers(): void
    {
        $repo = new UserRepository();
        $data = $repo->getAllUsers();
        $this->assertInstanceOf(LengthAwarePaginator::class, $repo->getAllUsers());
    }
}
