<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;
use Carbon\Carbon;

class ProfitLoss extends Component
{
    public $revenue = [], $expenses = [];
    public $totals = [
        'revenue' => 0,
        'expenses' => 0,
        'net_profit' => 0,
    ];
    public $startDate, $endDate;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->fetchProfitLoss();
    }

    public function fetchProfitLoss()
    {
        $accounts = Account::with(['ledgers' => function ($query) {
            $query->whereBetween('date', [$this->startDate, $this->endDate]);
        }])->get();

        $this->revenue = $accounts->where('type', 'Revenue');
        $this->expenses = $accounts->where('type', 'Expense');

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->totals['revenue'] = $this->revenue->sum(fn($r) => $r->ledgers->sum('credit_amount') - $r->ledgers->sum('debit_amount'));
        $this->totals['expenses'] = $this->expenses->sum(fn($e) => $e->ledgers->sum('debit_amount') - $e->ledgers->sum('credit_amount'));
        $this->totals['net_profit'] = $this->totals['revenue'] - $this->totals['expenses'];
    }

    public function render()
    {
        return view('livewire.profit-loss');
    }
}
