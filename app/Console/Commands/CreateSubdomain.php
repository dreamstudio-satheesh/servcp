<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class CreateSubdomain extends Command
{
    protected $signature = 'subdomain:create {name} {database}';
    protected $description = 'Create a new subdomain, migrate, and seed its database';

    public function handle()
    {
        $name = $this->argument('name');
        $database = $this->argument('database');

        // Step 1: Add Subdomain to the Mapping Table
        if (!Schema::hasTable('subdomains')) {
            $this->error("Subdomains table does not exist in the default database. Please create it first.");
            return 1;
        }

        DB::table('subdomains')->insertOrIgnore([
            'subdomain' => $name,
            'database_name' => $database,
        ]);

        $this->info("Subdomain '$name' added with database '$database'.");

        // Step 2: Create and Migrate the Tenant Database
        config(['database.connections.tenant' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => $database,
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
        ]]);

        // Create the database (if not exists)
        DB::statement("CREATE DATABASE IF NOT EXISTS `$database`");
        $this->info("Database '$database' created (if not exists).");

        // Run Tenant-Specific Migrations
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path' => '/database/migrations/tenants',
            '--force' => true,
        ]);
        $this->info("Tenant-specific migrations applied to '$database'.");

        // Run Seeder (optional)
        Artisan::call('db:seed', [
            '--database' => 'tenant',
            '--class' => 'Database\\Seeders\\Tenant\\TenantDbSeeder', 
            '--force' => true,
        ]);
        $this->info("Seeding completed for '$database'.");

        return 0;
    }
}
