<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Roles Seeder
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Administrator', 'description' => 'Has full access'], // Explicit ID for Administrator
            ['id' => 2, 'name' => 'Technician', 'description' => 'Handles repairs'], // Auto-increment ID
            ['id' => 3, 'name' => 'Store Keeper', 'description' => 'Manages inventory'], // Auto-increment ID
        ]);


        // Permissions Seeder
        $permissions = [
            ['name' => 'view_users', 'display_name' => 'View Users', 'category' => 'General'],
            ['name' => 'add_users', 'display_name' => 'Add Users', 'category' => 'General'],
            ['name' => 'edit_users', 'display_name' => 'Edit Users', 'category' => 'General'],
            ['name' => 'delete_users', 'display_name' => 'Delete Users', 'category' => 'General'],

            ['name' => 'view_services', 'display_name' => 'View Services', 'category' => 'Services'],
            ['name' => 'add_services', 'display_name' => 'Add Services', 'category' => 'Services'],
            ['name' => 'edit_services', 'display_name' => 'Edit Services', 'category' => 'Services'],
            ['name' => 'delete_services', 'display_name' => 'Delete Services', 'category' => 'Services'],

            ['name' => 'view_inventory', 'display_name' => 'View Inventory', 'category' => 'Store'],
            ['name' => 'add_inventory', 'display_name' => 'Add Inventory', 'category' => 'Store'],
            ['name' => 'edit_inventory', 'display_name' => 'Edit Inventory', 'category' => 'Store'],
            ['name' => 'delete_inventory', 'display_name' => 'Delete Inventory', 'category' => 'Store'],

            // Add more permissions as needed for Accounts, Reports, HR Management, etc.
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }

        // Assign All Permissions to Administrator Role
        $adminRoleId = 1; // Administrator role ID
        $permissionIds = DB::table('permissions')->pluck('id'); // Get all permission IDs
        foreach ($permissionIds as $permissionId) {
            DB::table('role_permissions')->insert([
                'role_id' => $adminRoleId,
                'permission_id' => $permissionId,
            ]);
        }

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'email' => 'admin@app.com',
                'role_id' => '1',
                'branch_id' => null,
                'password' => bcrypt('password'), // Use a secure password in production
            ]
        );
    }
}
