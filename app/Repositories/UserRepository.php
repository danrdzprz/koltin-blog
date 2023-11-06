<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function getAllUsers(): LengthAwarePaginator
    {
        return User::with('posts', 'comments')->paginate(15);
    }

    public function getUserById(int $UserId): User
    {
        return User::findOrFail($UserId);
    }

    public function getUserByEmal(string $UserEmail): User
    {
        return User::where(['email' => $UserEmail])->firstOrFail();
    }

    public function createUser(array $UserDetails): User
    {
        $UserDetails['password'] = Hash::make($UserDetails['password']);

        return User::create($UserDetails);
    }
}
