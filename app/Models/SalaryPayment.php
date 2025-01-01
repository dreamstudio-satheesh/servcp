<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'staff_id',
        'amount',
        'description',
        'payment_type',
    ];

    /**
     * Relationship: A salary payment belongs to a staff (user).
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Relationship: A salary payment may have additional details.
     */
    public function details()
    {
        return $this->hasOne(SalaryPaymentDetail::class, 'salary_payment_id');
    }
}
