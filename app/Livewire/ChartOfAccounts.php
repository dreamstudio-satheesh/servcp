<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Account;

class ChartOfAccounts extends Component
{
    public $accounts, $accountId, $name, $code, $type, $parent_id;
    public $types = ['Asset', 'Liability', 'Capital', 'Revenue', 'Expense'];

    public $isEdit = false; // To toggle between Add/Edit mode

    protected $rules = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|unique:accounts,code',
        'type' => 'required|in:Asset,Liability,Capital,Revenue,Expense',
        'parent_id' => 'nullable|exists:accounts,id',
    ];

    public function render()
    {
        $this->accounts = Account::with('children')->whereNull('parent_id')->get();
        return view('livewire.chart-of-accounts');
    }

    public function resetInput()
    {
        $this->accountId = null;
        $this->name = '';
        $this->code = '';
        $this->type = '';
        $this->parent_id = null;
        $this->isEdit = false;
    }

    public function store()
    {
        $this->validate();
        Account::create([
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'parent_id' => $this->parent_id,
        ]);
        session()->flash('message', 'Account created successfully.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $this->accountId = $account->id;
        $this->name = $account->name;
        $this->code = $account->code;
        $this->type = $account->type;
        $this->parent_id = $account->parent_id;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:accounts,code,' . $this->accountId,
            'type' => 'required|in:Asset,Liability,Capital,Revenue,Expense',
            'parent_id' => 'nullable|exists:accounts,id',
        ]);

        $account = Account::findOrFail($this->accountId);
        $account->update([
            'name' => $this->name,
            'code' => $this->code,
            'type' => $this->type,
            'parent_id' => $this->parent_id,
        ]);

        session()->flash('message', 'Account updated successfully.');
        $this->resetInput();
    }
    

    public function delete($id)
    {
        $account = Account::with('children')->findOrFail($id);

        // Prevent deletion if the account is a primary account (has no parent)
        if (is_null($account->parent_id) || $account->children->count() > 0) {
            session()->flash('message', 'Cannot delete primary account or account with children.');
            return;
        }

        $account->delete();

        session()->flash('message', 'Account deleted successfully.');
    }
}
