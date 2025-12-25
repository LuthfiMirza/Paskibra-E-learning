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
        User::firstOrCreate(
            ['email' => 'admin@paskibra.edu'],
            [
            'name' => 'Super Admin',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'learning_level' => 'instruktur',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        // Create Admin User
        User::firstOrCreate(
            ['email' => 'admin@school.edu'],
            [
            'name' => 'Admin PASKIBRA',
            'email_verified_at' => now(),
            'password' => Hash::make('paskibra123'),
            'role' => 'admin',
            'learning_level' => 'instruktur',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        // Create Instructor/Pembina
        User::firstOrCreate(
            ['email' => 'pembina@school.edu'],
            [
            'name' => 'Pembina PASKIBRA',
            'email_verified_at' => now(),
            'password' => Hash::make('pembina123'),
            'role' => 'instructor',
            'learning_level' => 'instruktur',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        // Create Sample Students
        User::firstOrCreate(
            ['email' => 'ahmad.rizki@student.edu'],
            [
            'name' => 'Ahmad Rizki Pratama',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'umum',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'siti.nurhaliza@student.edu'],
            [
            'name' => 'Siti Nurhaliza',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'calon_paskibra',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'budi.santoso@student.edu'],
            [
            'name' => 'Budi Santoso',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'wiramuda',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'dewi.sartika@student.edu'],
            [
            'name' => 'Dewi Sartika',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'wiratama',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'andi.wijaya@student.edu'],
            [
            'name' => 'Andi Wijaya',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'role' => 'student',
            'learning_level' => 'instruktur_muda',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
            ]
        );
    }
}
