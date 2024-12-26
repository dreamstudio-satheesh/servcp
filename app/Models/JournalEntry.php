<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $fillable = ['date', 'description'];

    // Relationship with journal entry lines
    public function lines()
    {
        return $this->hasMany(JournalEntryLine::class);
    }
}
