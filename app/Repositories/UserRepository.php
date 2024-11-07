<?php

namespace App\Repositories;

use App\Data\UserData;
use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function __construct(public User $user)
    {
    }

    static public function store(UserData $data): User
    {
        $user = User::query()->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password)
        ]);

        UserCreated::dispatch($user);

        return $user;
    }

    public function update(UserData $data): bool
    {
        return $this->user->update([
            'name' => $data->name,
            'email' => $data->email,
            'password' => Hash::make($data->password),
        ]);
    }

    public function destroy(): bool
    {
        return $this->user->delete();
    }
}
