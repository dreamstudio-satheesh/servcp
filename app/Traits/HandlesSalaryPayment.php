<?php

namespace App\Traits;

use App\Models\SalaryPayment;
use App\Models\SalaryPaymentDetail;
use App\Models\Ledger;

trait HandlesSalaryPayment
{
    public function createSalaryPayment($data)
    {
        // Create Salary Payment
        $salaryPayment = SalaryPayment::create([
            'date' => $data['date'],
            'staff_id' => $data['staff_id'],
            'amount' => $data['amount'],
            'description' => $data['description'],
            'payment_type' => $data['payment_type'],
        ]);

        // Add Payment Details if needed
        if (in_array($data['payment_type'], ['Cheque', 'Digital'])) {
            SalaryPaymentDetail::create([
                'salary_payment_id' => $salaryPayment->id,
                'amount' => $data['amount'],
                'cheque_no' => $data['cheque_no'] ?? null,
                'due_date' => $data['due_date'] ?? null,
                'bank_name' => $data['bank_name'] ?? null,
                'account_id' => $data['account_id'] ?? null,
                'remarks' => $data['remarks'] ?? null,
            ]);
        }

        // Create Ledger Entries for Double-Entry Accounting
        $this->createLedgerEntries($salaryPayment);

        return $salaryPayment;
    }

    public function createLedgerEntries($salaryPayment)
    {
        // Debit Salary Expense Account
        Ledger::create([
            'account_id' => $this->getAccountIdByName('Salary Expense'),
            'date' => $salaryPayment->date,
            'description' => 'Salary payment for staff: ' . $salaryPayment->staff->name,
            'debit_amount' => $salaryPayment->amount,
            'credit_amount' => 0,
        ]);

        // Credit Payment Method Account
        Ledger::create([
            'account_id' => $this->getAccountIdByPaymentType($salaryPayment->payment_type, $salaryPayment->account_id),
            'date' => $salaryPayment->date,
            'description' => 'Salary payment for staff: ' . $salaryPayment->staff->name,
            'debit_amount' => 0,
            'credit_amount' => $salaryPayment->amount,
        ]);
    }

    private function getAccountIdByName($name)
    {
        return \App\Models\Account::where('name', $name)->first()->id;
    }

    private function getAccountIdByPaymentType($type, $accountId = null)
    {
        if ($type === 'Cash') {
            return $this->getAccountIdByName('Cash');
        } elseif (in_array($type, ['Cheque', 'Digital'])) {
            return $accountId;
        }
        return null;
    }
}
