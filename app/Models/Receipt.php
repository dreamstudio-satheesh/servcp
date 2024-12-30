<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends TenantModel
{
    protected $fillable = ['account_id', 'date', 'reference', 'description', 'amount', 'entry_staff_id'];

    // Relationship to Account
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // Relationship to Staff
    public function staff()
    {
        return $this->belongsTo(User::class, 'entry_staff_id');
    }
}
