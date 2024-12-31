<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Database\Seeders\Tenant\AdminSeeder;
use Database\Seeders\Tenant\AccountsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([AdminSeeder::class, AccountsSeeder::class,]);



        // Device Companies Seeder
        DB::table('device_companies')->insert([
            ['name' => 'Apple'],
            ['name' => 'Samsung'],
            ['name' => 'Sony'],
        ]);

        // Device Colors Seeder
        DB::table('device_colors')->insert([
            ['name' => 'Black'],
            ['name' => 'White'],
            ['name' => 'Silver'],
        ]);

        // Device Physical Conditions Seeder
        DB::table('device_physical_conditions')->insert([
            ['name' => 'Good'],
            ['name' => 'Minor Scratches'],
            ['name' => 'Damaged'],
        ]);

        // Device Accessories Seeder
        DB::table('device_accessories')->insert([
            ['name' => 'Charger', 'with_serial_no' => false],
            ['name' => 'Headphones', 'with_serial_no' => false],
            ['name' => 'Battery', 'with_serial_no' => true],
        ]);

        // Service Complaints Seeder
        DB::table('service_complaints')->insert([
            ['name' => 'Battery Issue'],
            ['name' => 'Screen Replacement'],
            ['name' => 'Charging Port Issue'],
        ]);

        // Complaint Estimates Seeder
        DB::table('complaint_estimates')->insert([
            ['service_complaint_id' => 1, 'estimate_amount' => 1500],
            ['service_complaint_id' => 2, 'estimate_amount' => 5000],
        ]);

        // Initial Checks Seeder
        DB::table('initial_checks')->insert([
            ['name' => 'Screen Damage'],
            ['name' => 'Battery Health'],
        ]);

        // Service Reports Seeder
        DB::table('service_reports')->insert([
            ['name' => 'Ready'],
            ['name' => 'In Progress'],
        ]);

        // Printable Reports Seeder
        DB::table('printable_reports')->insert([
            ['name' => 'Customer Invoice'],
            ['name' => 'Repair Summary'],
        ]);

        // Risk Agreements Seeder
        DB::table('risk_agreements')->insert([
            ['name' => 'Data Loss Agreement'],
            ['name' => 'Physical Damage Agreement'],
        ]);

        // Store Item Categories Seeder
        DB::table('store_item_categories')->insert([
            ['name' => 'Smartphones'],
            ['name' => 'Accessories'],
        ]);

        // Quality Checks Seeder
        DB::table('quality_checks')->insert([
            ['name' => 'Screen Test'],
            ['name' => 'Battery Test'],
        ]);

        // Currencies Seeder
        DB::table('currencies')->insert([
            ['name' => 'USD', 'symbol' => '$'],
            ['name' => 'INR', 'symbol' => '₹'],
        ]);

        // Print Sizes Seeder
        DB::table('print_sizes')->insert([
            ['name' => 'Full Page', 'height' => 11.0, 'width' => 8.5, 'remarks' => 'A4 Size'],
            ['name' => 'Half Page', 'height' => 5.5, 'width' => 8.5, 'remarks' => 'Half A4 Size'],
        ]);

        // Device Models Seeder
        DB::table('device_models')->insert([
            ['company_id' => 1, 'name' => 'iPhone 13'],
            ['company_id' => 2, 'name' => 'Galaxy S21'],
        ]);

        // Service Customers Seeder
        DB::table('service_customers')->insert([
            ['name' => 'John Doe', 'phone' => '1234567890', 'username' => 'john.doe', 'password' => bcrypt('password'), 'email' => 'john@example.com'],
            ['name' => 'Jane Smith', 'phone' => '9876543210', 'username' => 'jane.smith', 'password' => bcrypt('password'), 'email' => 'jane@example.com'],
        ]);

        // Outside Service Centers Seeder
        DB::table('outside_service_centers')->insert([
            ['name' => 'Repair Hub', 'phone' => '1234567890', 'place' => 'City Center'],
            ['name' => 'Tech Fix', 'phone' => '9876543210', 'place' => 'Downtown'],
        ]);

        // Store Dealers Seeder
        DB::table('store_dealers')->insert([
            ['name' => 'Dealer A', 'phone' => '111222333', 'place' => 'Market Area'],
            ['name' => 'Dealer B', 'phone' => '444555666', 'place' => 'Industrial Zone'],
        ]);

        // Vendors Seeder
        DB::table('vendors')->insert([
            ['name' => 'Vendor A', 'phone' => '999888777', 'place' => 'City A'],
            ['name' => 'Vendor B', 'phone' => '666555444', 'place' => 'City B'],
        ]);

        // Device Blacklists Seeder
        DB::table('device_blacklists')->insert([
            ['blacklisted_date' => '2024-12-25', 'imei' => '123456789012345', 'company_id' => 1, 'model_id' => 1, 'phone' => '1234567890'],
        ]);

        // Store Taxes Seeder
        DB::table('store_taxes')->insert([
            ['name' => 'GST@18%', 'percentage' => 18],
            ['name' => 'GST@5%', 'percentage' => 5],
        ]);

        // Units Seeder
        DB::table('units')->insert([
            ['name' => 'Piece', 'base_quantity' => 1],
            ['name' => 'Box', 'base_quantity' => 10],
        ]);

        // Entry Via Options Seeder
        DB::table('entry_via_options')->insert([
            ['name' => 'Walk-In'],
            ['name' => 'Online'],
        ]);
    }
}
