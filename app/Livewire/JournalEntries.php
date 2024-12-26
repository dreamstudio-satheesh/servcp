<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\JournalEntry;
use App\Models\JournalEntryLine;
use App\Models\Account;

class JournalEntries extends Component
{
    public $journalEntries, $accounts, $date, $description;
    public $lines = [];

    protected $rules = [
        'date' => 'required|date',
        'description' => 'nullable|string|max:255',
        'lines.*.account_id' => 'required|exists:accounts,id',
        'lines.*.debit_amount' => 'nullable|numeric|min:0',
        'lines.*.credit_amount' => 'nullable|numeric|min:0',
    ];

    public function mount()
    {
        $this->accounts = Account::all(); // Load accounts for dropdown
        $this->fetchJournalEntries();
        $this->addEmptyLine(); // Add an initial line
    }

    public function fetchJournalEntries()
    {
        $this->journalEntries = JournalEntry::with('lines.account')->orderBy('date', 'desc')->get();
    }

    public function addEmptyLine()
    {
        $this->lines[] = [
            'account_id' => '',
            'debit_amount' => 0,
            'credit_amount' => 0,
        ];
    }

    public function removeLine($index)
    {
        unset($this->lines[$index]);
        $this->lines = array_values($this->lines); // Reindex the array
    }

    public function store()
    {
        $this->validate();

        $totalDebit = array_sum(array_column($this->lines, 'debit_amount'));
        $totalCredit = array_sum(array_column($this->lines, 'credit_amount'));

        if ($totalDebit != $totalCredit) {
            session()->flash('error', 'Total Debit must equal Total Credit.');
            return;
        }

        $journalEntry = JournalEntry::create([
            'date' => $this->date,
            'description' => $this->description,
        ]);

        foreach ($this->lines as $line) {
            JournalEntryLine::create([
                'journal_entry_id' => $journalEntry->id,
                'account_id' => $line['account_id'],
                'debit_amount' => $line['debit_amount'],
                'credit_amount' => $line['credit_amount'],
            ]);
        }

        session()->flash('message', 'Journal entry created successfully.');
        $this->resetForm();
        $this->fetchJournalEntries();
    }

    public function resetForm()
    {
        $this->date = '';
        $this->description = '';
        $this->lines = [];
        $this->addEmptyLine();
    }

    public function render()
    {
        return view('livewire.journal-entries');
    }
}
