<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'staff'],
            ['name' => 'user'],
        ];

        foreach ($roles as $data) {
            Role::firstOrCreate(['name' => $data['name']], $data);
        }
    }
}
