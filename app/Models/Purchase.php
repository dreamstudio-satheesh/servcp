<?php

namespace App\Models;

use App\Models\Master\Vendor;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_no',
        'reference_no',
        'vendor_id',
        'salesman_id',
        'remarks',
        'total_cost',
        'discount',
        'courier_cost',
    ];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }
}
