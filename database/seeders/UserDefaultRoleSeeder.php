<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserDefaultRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Prefer the 'user' role id; fallback to 3 if not found
        $roleId = Role::where('name', 'user')->value('id') ?? 3;

        User::whereNull('role_id')->update(['role_id' => $roleId]);
    }
}
