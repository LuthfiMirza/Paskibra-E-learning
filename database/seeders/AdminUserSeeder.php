<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@paskibra.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'learning_level' => 'instruktur',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Admin User
        User::create([
            'name' => 'Admin PASKIBRA',
            'email' => 'admin@school.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('paskibra123'),
            'role' => 'admin',
            'learning_level' => 'instruktur',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Instructor/Pembina
        User::create([
            'name' => 'Pembina PASKIBRA',
            'email' => 'pembina@school.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('pembina123'),
            'role' => 'instructor',
            'learning_level' => 'instruktur',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create Sample Students
        User::create([
            'name' => 'Ahmad Rizki Pratama',
            'email' => 'ahmad.rizki@student.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'umum',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@student.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'calon_paskibra',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@student.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'wiramuda',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi.sartika@student.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'wiratama',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi.wijaya@student.edu',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'instruktur_muda',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
