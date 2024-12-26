<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ledger;
use App\Models\Account;
use Carbon\Carbon;

class Ledgers extends Component
{
    public $ledgers, $accounts;
    public $account_id, $date, $description, $debit_amount, $credit_amount;
    public $startDate, $endDate;

    protected $rules = [
        'account_id' => 'required|exists:accounts,id',
        'date' => 'required|date',
        'description' => 'nullable|string|max:255',
        'debit_amount' => 'required_without:credit_amount|numeric|min:0',
        'credit_amount' => 'required_without:debit_amount|numeric|min:0',
    ];

    public function mount()
    {
        $this->accounts = Account::all(); // Load accounts for dropdown
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->format('Y-m-d');
        $this->fetchLedgers();
    }

    public function fetchLedgers()
    {
        $this->ledgers = Ledger::with('account')
            ->when($this->account_id, function ($query) {
                $query->where('account_id', $this->account_id);
            })
            ->when($this->startDate && $this->endDate, function ($query) {
                $query->whereBetween('date', [$this->startDate, $this->endDate]);
            })
            ->orderBy('date', 'asc')
            ->get();
    }

    public function store()
    {
        $this->validate();

        Ledger::create([
            'account_id' => $this->account_id,
            'date' => $this->date,
            'description' => $this->description,
            'debit_amount' => $this->debit_amount ?? 0,
            'credit_amount' => $this->credit_amount ?? 0,
        ]);

        session()->flash('message', 'Ledger entry added successfully.');
        $this->resetInput();
        $this->fetchLedgers();
    }

    public function resetInput()
    {
        $this->account_id = '';
        $this->date = '';
        $this->description = '';
        $this->debit_amount = '';
        $this->credit_amount = '';
    }

    public function delete($id)
    {
        Ledger::findOrFail($id)->delete();
        session()->flash('message', 'Ledger entry deleted successfully.');
        $this->fetchLedgers();
    }

    public function render()
    {
        return view('livewire.ledger');
    }
}
