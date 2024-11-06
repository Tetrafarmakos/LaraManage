<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'manage users']);

        $admin = User::query()->where('name', 'admin')->first();
        $adminRole = Role::create(['name' => 'admin']);
        $admin->assignRole('admin');
        $adminRole->givePermissionTo('manage users');

        $user = User::query()->where('name', 'user')->first();
        $userRole = Role::create(['name' => 'user']);
        $user->assignRole('user');


    }
}
