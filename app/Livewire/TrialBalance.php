<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use App\Models\Ledger;
use Carbon\Carbon;

class TrialBalance extends Component
{
    public $accounts = [];
    public $startDate, $endDate;
    public $totals = [
        'debit' => 0,
        'credit' => 0,
    ];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->fetchTrialBalance();
    }

    public function fetchTrialBalance()
    {
        $this->accounts = Account::with(['ledgers' => function ($query) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }])->get();

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totals = ['debit' => 0, 'credit' => 0];

        foreach ($this->accounts as $account) {
            $debit = $account->ledgers->sum('debit_amount');
            $credit = $account->ledgers->sum('credit_amount');

            $this->totals['debit'] += $debit;
            $this->totals['credit'] += $credit;

            $account->total_debit = $debit;
            $account->total_credit = $credit;
        }
    }

    public function render()
    {
        return view('livewire.trial-balance');
    }
}
