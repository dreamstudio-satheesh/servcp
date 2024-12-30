<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends TenantModel
{
    protected $fillable = ['code', 'name', 'type', 'parent_id'];

    // Parent account relationship
    public function parent()
    {
        return $this->belongsTo(Account::class, 'parent_id');
    }

    // Child accounts relationship
    public function children()
    {
        return $this->hasMany(Account::class, 'parent_id');
    }

    // Ledgers relationship
    public function ledgers()
    {
        return $this->hasMany(Ledger::class);
    }
}
