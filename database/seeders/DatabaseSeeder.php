<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Database\Seeders\EquipmentSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create or update admin user benjie20 (user: benjie20, pass: benjie062606)
        User::updateOrCreate(
            ['username' => 'benjie20'],
            [
                'name' => 'Benjie',
                'email' => 'benjie20@clfms.com',
                'username' => 'benjie20',
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
        $this->command->info('Admin: benjie20 (benjie20@clfms.com or username benjie20) / benjie062606');
        $this->command->info('Staff: staff@clfms.com / password');
        $this->command->info('Student: john@clfms.com / password');

        // Seed equipment inventory (ICT equipments)
        $this->call(EquipmentSeeder::class);

    }
}

