<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntryLine extends TenantModel
{
    protected $fillable = ['journal_entry_id', 'account_id', 'debit_amount', 'credit_amount'];

    // Relationship with journal entry
    public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }

    // Relationship with account
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
