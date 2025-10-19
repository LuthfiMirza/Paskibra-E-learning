<?php

namespace Database\Seeders;

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
        $guard = 'web';

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
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => $guard]
            );
        }

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin',
            'guard_name' => $guard,
        ]);

        $adminRole = Role::firstOrCreate([
            'name' => 'admin',
            'guard_name' => $guard,
        ]);

        $instructorRole = Role::firstOrCreate([
            'name' => 'instructor',
            'guard_name' => $guard,
        ]);

        $memberRole = Role::firstOrCreate([
            'name' => 'member',
            'guard_name' => $guard,
        ]);

        $superAdminRole->syncPermissions(Permission::all());

        $adminRole->syncPermissions([
            'manage_users', 'view_users', 'create_users', 'edit_users',
            'manage_courses', 'view_courses', 'create_courses', 'edit_courses',
            'manage_quizzes', 'view_quizzes', 'create_quizzes', 'edit_quizzes',
            'manage_announcements', 'view_announcements', 'create_announcements', 'edit_announcements',
            'view_reports', 'export_data',
        ]);

        $instructorRole->syncPermissions([
            'view_users',
            'view_courses', 'create_courses', 'edit_courses',
            'view_quizzes', 'create_quizzes', 'edit_quizzes',
            'view_announcements', 'create_announcements',
            'view_reports',
        ]);

        $memberRole->syncPermissions([
            'view_courses',
            'view_quizzes', 'take_quizzes',
            'view_announcements',
            'view_achievements',
        ]);

        $superAdminUser = User::updateOrCreate(
            ['email' => 'admin@paskibra.com'],
            [
                'name' => 'Super Admin PASKIBRA',
                'password' => Hash::make('admin123'),
                'nis' => 'ADM001',
                'angkatan' => 2024,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $superAdminUser->syncRoles([$superAdminRole]);

        $instructorUser = User::updateOrCreate(
            ['email' => 'pelatih@paskibra.com'],
            [
                'name' => 'Pelatih PASKIBRA',
                'password' => Hash::make('pelatih123'),
                'nis' => 'PLT001',
                'angkatan' => 2020,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $instructorUser->syncRoles([$instructorRole]);

        $memberUser = User::updateOrCreate(
            ['email' => 'anggota@paskibra.com'],
            [
                'name' => 'Anggota PASKIBRA',
                'password' => Hash::make('anggota123'),
                'nis' => 'AGT001',
                'angkatan' => 2024,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $memberUser->syncRoles([$memberRole]);
    }
}
