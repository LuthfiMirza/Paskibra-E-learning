<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // User management
            'manage_users',
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            
            // Course management
            'manage_courses',
            'view_courses',
            'create_courses',
            'edit_courses',
            'delete_courses',
            
            // Quiz management
            'manage_quizzes',
            'view_quizzes',
            'create_quizzes',
            'edit_quizzes',
            'delete_quizzes',
            'take_quizzes',
            
            // Announcement management
            'manage_announcements',
            'view_announcements',
            'create_announcements',
            'edit_announcements',
            'delete_announcements',
            
            // Achievement management
            'manage_achievements',
            'view_achievements',
            'create_achievements',
            'edit_achievements',
            'delete_achievements',
            
            // Reports and analytics
            'view_reports',
            'export_data',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::create(['name' => 'super_admin']);
        $admin = Role::create(['name' => 'admin']);
        $instructor = Role::create(['name' => 'instructor']);
        $member = Role::create(['name' => 'member']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        
        $admin->givePermissionTo([
            'manage_users', 'view_users', 'create_users', 'edit_users',
            'manage_courses', 'view_courses', 'create_courses', 'edit_courses',
            'manage_quizzes', 'view_quizzes', 'create_quizzes', 'edit_quizzes',
            'manage_announcements', 'view_announcements', 'create_announcements', 'edit_announcements',
            'view_reports', 'export_data'
        ]);
        
        $instructor->givePermissionTo([
            'view_users',
            'view_courses', 'create_courses', 'edit_courses',
            'view_quizzes', 'create_quizzes', 'edit_quizzes',
            'view_announcements', 'create_announcements',
            'view_reports'
        ]);
        
        $member->givePermissionTo([
            'view_courses',
            'view_quizzes', 'take_quizzes',
            'view_announcements',
            'view_achievements'
        ]);

        // Create default super admin user
        $superAdminUser = User::create([
            'name' => 'Super Admin PASKIBRA',
            'email' => 'admin@paskibra.com',
            'password' => Hash::make('admin123'),
            'nis' => 'ADM001',
            'angkatan' => 2024,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        
        $superAdminUser->assignRole('super_admin');

        // Create sample instructor
        $instructor = User::create([
            'name' => 'Pelatih PASKIBRA',
            'email' => 'pelatih@paskibra.com',
            'password' => Hash::make('pelatih123'),
            'nis' => 'PLT001',
            'angkatan' => 2020,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        
        $instructor->assignRole('instructor');

        // Create sample member
        $memberUser = User::create([
            'name' => 'Anggota PASKIBRA',
            'email' => 'anggota@paskibra.com',
            'password' => Hash::make('anggota123'),
            'nis' => 'AGT001',
            'angkatan' => 2024,
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        
        $memberUser->assignRole('member');
    }
}