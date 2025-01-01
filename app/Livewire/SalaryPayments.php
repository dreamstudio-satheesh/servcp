<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SalaryPayment;
use App\Models\User;
use App\Models\Account;
use App\Traits\HandlesSalaryPayment;

class SalaryPayments extends Component
{
    use WithPagination, HandlesSalaryPayment;

    public $date, $staff_id, $amount, $description, $payment_type = 'Cash';
    public $cheque_no, $due_date, $bank_name, $account_id, $remarks;
    public $showForm = false;

    protected $rules = [
        'date' => 'required|date',
        'staff_id' => 'required|exists:users,id',
        'amount' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'payment_type' => 'required|in:Cash,Cheque,Digital,Balance',
        'cheque_no' => 'nullable|string|required_if:payment_type,Cheque',
        'due_date' => 'nullable|date|required_if:payment_type,Cheque',
        'bank_name' => 'nullable|string|required_if:payment_type,Cheque,Digital',
        'account_id' => 'nullable|exists:accounts,id|required_if:payment_type,Digital',
        'remarks' => 'nullable|string',
    ];

    public function render()
    {
        $payments = SalaryPayment::with('staff')->latest()->paginate(10);
        $staff = User::all();
        $accounts = Account::all();
        return view('livewire.salary-payment', compact('payments', 'staff', 'accounts'));
    }

    public function createPayment()
    {
        $this->resetInputFields();
        $this->showForm = true;
    }

    public function store()
    {
        $this->validate();

        $this->createSalaryPayment([
            'date' => $this->date,
            'staff_id' => $this->staff_id,
            'amount' => $this->amount,
            'description' => $this->description,
            'payment_type' => $this->payment_type,
            'cheque_no' => $this->cheque_no,
            'due_date' => $this->due_date,
            'bank_name' => $this->bank_name,
            'account_id' => $this->account_id,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Salary Payment added successfully!');
        $this->resetInputFields();
        $this->showForm = false;
    }

    private function resetInputFields()
    {
        $this->date = $this->staff_id = $this->amount = $this->description = null;
        $this->payment_type = 'Cash';
        $this->cheque_no = $this->due_date = $this->bank_name = $this->account_id = $this->remarks = null;
    }
}
