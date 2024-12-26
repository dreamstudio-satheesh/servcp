<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            ['name' => 'home', 'display_name' => 'Home', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'services', 'display_name' => 'Services', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'job_entry', 'display_name' => 'Job Entry', 'parent_id' => 2, 'category' => 'Services'],
            ['name' => 'reports', 'display_name' => 'Reports', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'service_reports', 'display_name' => 'Service Reports', 'parent_id' => 4, 'category' => 'Reports'],
            ['name' => 'store', 'display_name' => 'Store', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'item_register', 'display_name' => 'Item Register', 'parent_id' => 6, 'category' => 'Store'],
            ['name' => 'accounts', 'display_name' => 'Accounts', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'ledger', 'display_name' => 'Ledger', 'parent_id' => 8, 'category' => 'Accounts'],
            ['name' => 'hr_management', 'display_name' => 'HR Management', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'user_management', 'display_name' => 'User Management', 'parent_id' => 10, 'category' => 'HR Management'],
            ['name' => 'settings', 'display_name' => 'Settings', 'parent_id' => null, 'category' => 'Main'],
            ['name' => 'roles', 'display_name' => 'Roles', 'parent_id' => 12, 'category' => 'Settings'],
            ['name' => 'privilege_settings', 'display_name' => 'Privilege Settings', 'parent_id' => 12, 'category' => 'Settings'],
            ['name' => 'branch_register', 'display_name' => 'Branch Register', 'parent_id' => 12, 'category' => 'Settings'],
            ['name' => 'database_backup', 'display_name' => 'Database Backup', 'parent_id' => 12, 'category' => 'Settings']
        ];

        foreach ($menus as $menu) {
            DB::table('menus')->insert($menu);
        }
    }
}
