<?php

namespace App\Repositories;

use App\Data\UserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function __construct(public User $user)
    {
    }

    static public function store(UserData $data): User
    {
        return User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }
}
