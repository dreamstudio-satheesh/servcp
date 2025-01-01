<?php

namespace Database\Seeders\Tenant;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountsSeeder extends Seeder
{
    public function run()
    {
        // Parent accounts
        $asset = Account::create(['code' => '1000', 'name' => 'Asset', 'type' => 'Asset']);
        $liability = Account::create(['code' => '2000', 'name' => 'Liability', 'type' => 'Liability']);
        $expense = Account::create(['code' => '3000', 'name' => 'Expense', 'type' => 'Expense']);
        $revenue = Account::create(['code' => '4000', 'name' => 'Revenue', 'type' => 'Revenue']);

        // Child accounts under Asset
        Account::create(['code' => '1001', 'name' => 'Cash', 'type' => 'Asset', 'parent_id' => $asset->id]);
        Account::create(['code' => '1002', 'name' => 'Bank Accounts', 'type' => 'Asset', 'parent_id' => $asset->id]);

        // Child accounts under Liability
        Account::create(['code' => '2001', 'name' => 'Loans', 'type' => 'Liability', 'parent_id' => $liability->id]);
        Account::create(['code' => '2002', 'name' => 'Payables', 'type' => 'Liability', 'parent_id' => $liability->id]);

        // Child accounts under Expense
        Account::create(['code' => '3001', 'name' => 'Office Supplies', 'type' => 'Expense', 'parent_id' => $expense->id]);
        Account::create(['code' => '3002', 'name' => 'Utilities', 'type' => 'Expense', 'parent_id' => $expense->id]);
        Account::create(['code' => '3003', 'name' => 'Travel', 'type' => 'Expense', 'parent_id' => $expense->id]);
        Account::create(['code' => '3007', 'name' => 'Salary', 'type' => 'Expense', 'parent_id' => $expense->id]);
        Account::create(['code' => '3008', 'name' => 'Round Off Expense', 'type' => 'Expense', 'parent_id' => $expense->id]);

        // Child accounts under Revenue
        Account::create(['code' => '4001', 'name' => 'Service Income', 'type' => 'Revenue', 'parent_id' => $revenue->id]);
        Account::create(['code' => '4002', 'name' => 'Sales', 'type' => 'Revenue', 'parent_id' => $revenue->id]);
        Account::create(['code' => '4003', 'name' => 'Sales Return', 'type' => 'Revenue', 'parent_id' => $revenue->id]);
    }
}
