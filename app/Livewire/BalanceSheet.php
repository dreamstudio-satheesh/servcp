<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use Carbon\Carbon;

class BalanceSheet extends Component
{
    public $assets = [], $liabilities = [], $equity = [];
    public $totals = [
        'assets' => 0,
        'liabilities' => 0,
        'equity' => 0,
    ];
    public $date;

    public function mount()
    {
        $this->date = Carbon::now()->format('Y-m-d');
        $this->fetchBalanceSheet();
    }

    public function fetchBalanceSheet()
    {
        $accounts = Account::with(['ledgers' => function ($query) {
            $query->where('date', '<=', $this->date);
        }])->get();

        $this->assets = $accounts->where('type', 'Asset');
        $this->liabilities = $accounts->where('type', 'Liability');
        $this->equity = $accounts->where('type', 'Equity');

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totals = [
            'assets' => $this->assets->sum(fn($a) => $a->ledgers->sum('debit_amount') - $a->ledgers->sum('credit_amount')),
            'liabilities' => $this->liabilities->sum(fn($l) => $l->ledgers->sum('credit_amount') - $l->ledgers->sum('debit_amount')),
            'equity' => $this->equity->sum(fn($e) => $e->ledgers->sum('credit_amount') - $e->ledgers->sum('debit_amount')),
        ];
    }

    public function render()
    {
        return view('livewire.balance-sheet');
    }
}
