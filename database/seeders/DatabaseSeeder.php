<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user with specified credentials (only if not exists)
        User::firstOrCreate(
            ['email' => 'benjadmin@clfms.com'],
            [
                'name' => 'benjadmin',
                'password' => Hash::make('benjie062606'),
                'password_hint' => '606',
                'role' => 'admin',
            ]
        );

        // Create staff user (only if not exists)
        User::firstOrCreate(
            ['email' => 'staff@clfms.com'],
            [
                'name' => 'Staff Member',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        );

        // Create student users (only if not exists)
        User::firstOrCreate(
            ['email' => 'john@clfms.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        User::firstOrCreate(
            ['email' => 'jane@clfms.com'],
            [
                'name' => 'Jane Smith',
                'password' => Hash::make('password'),
                'role' => 'student',
            ]
        );

        $this->command->info('Database seeded successfully!');
        $this->command->info('Login credentials:');
        $this->command->info('Admin: admin@clfms.com / password');
        $this->command->info('Staff: staff@clfms.com / password');
        $this->command->info('Student: john@clfms.com / password');
    }
}
