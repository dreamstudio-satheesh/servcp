<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends TenantModel
{
    protected $fillable = ['account_id', 'date', 'description', 'debit_amount', 'credit_amount'];

    // Account relationship
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}

