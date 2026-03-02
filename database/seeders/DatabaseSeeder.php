<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create Super Admin user with avatar
        User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'employee_id' => 'EMP001',
                'name' => 'Super Admin',
                'mobile_number' => '09123456789',
                'join_date' => now(),
                'role_id' => $superAdminRole->id,
                'password' => Hash::make('superadmin123'),
                'email_verified_at' => now(),
                'avatar_image' => 'avatar/default.png', 
            ]
        );
    }
}