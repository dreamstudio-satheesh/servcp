<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountsSeeder extends Seeder
{
    public function run()
    {
        // Parent accounts
        $expense = Account::create(['code' => '3000', 'name' => 'Expense', 'type' => 'Expense']);
        $revenue = Account::create(['code' => '4000', 'name' => 'Revenue', 'type' => 'Revenue']);

        // Child accounts under Expense
        Account::create(['code' => '3007', 'name' => 'Salary', 'type' => 'Expense', 'parent_id' => $expense->id]);
        Account::create(['code' => '3008', 'name' => 'Round Off Expense', 'type' => 'Expense', 'parent_id' => $expense->id]);

        // Child accounts under Revenue
        Account::create(['code' => '4002', 'name' => 'Sales', 'type' => 'Revenue', 'parent_id' => $revenue->id]);
        Account::create(['code' => '4003', 'name' => 'Sales Return', 'type' => 'Revenue', 'parent_id' => $revenue->id]);
    }
}
