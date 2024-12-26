<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Receipt;
use App\Models\Account;
use Illuminate\Support\Facades\Auth;

class ReceiptEntry extends Component
{
    public $receipts, $accounts;
    public $account_id, $date, $reference, $description, $amount;

    protected $rules = [
        'account_id' => 'required|exists:accounts,id',
        'date' => 'required|date',
        'reference' => 'nullable|string|max:255',
        'description' => 'nullable|string|max:255',
        'amount' => 'required|numeric|min:0.01',
    ];

    public function mount()
    {
        $this->accounts = Account::all(); // Load accounts for dropdown
        $this->fetchReceipts();
    }

    public function fetchReceipts()
    {
        $this->receipts = Receipt::with('account', 'staff')->orderBy('date', 'desc')->get();
    }

    public function store()
    {
        $this->validate();

        Receipt::create([
            'account_id' => $this->account_id,
            'date' => $this->date,
            'reference' => $this->reference,
            'description' => $this->description,
            'amount' => $this->amount,
            'entry_staff_id' => Auth::id(),
        ]);

        session()->flash('message', 'Receipt added successfully.');
        $this->resetInput();
        $this->fetchReceipts();
    }

    public function resetInput()
    {
        $this->account_id = '';
        $this->date = '';
        $this->reference = '';
        $this->description = '';
        $this->amount = '';
    }

    public function delete($id)
    {
        Receipt::findOrFail($id)->delete();
        session()->flash('message', 'Receipt deleted successfully.');
        $this->fetchReceipts();
    }

    public function render()
    {
        return view('livewire.receipt-entry');
    }
}
