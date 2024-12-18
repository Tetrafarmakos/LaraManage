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
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'manage companies']);
        Permission::firstOrCreate(['name' => 'manage projects']);
        Permission::firstOrCreate(['name' => 'access my company']);
        Permission::firstOrCreate(['name' => 'access my project']);

        $admin = User::query()->where('name', 'admin')->first();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $admin->assignRole('admin');
        $adminRole->givePermissionTo('manage users');
        $adminRole->givePermissionTo('manage companies');
        $adminRole->givePermissionTo('manage projects');

        $user = User::query()->where('name', 'user')->first();
        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo('access my company');
        $userRole->givePermissionTo('access my project');
        $user->assignRole('user');


    }
}
