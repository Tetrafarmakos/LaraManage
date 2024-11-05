<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'testuser@laramanage.com'],
            [
                'name' => 'user',
                'password' => bcrypt('password'),
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'testadmin@laramanage.com'],
            [
                'name' => 'admin',
                'password' => bcrypt('password'),
            ]
        );
    }
}
