<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'item_id',
        'quantity',
        'selling_price',
        'tax',
        'total',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function item()
    {
        return $this->belongsTo(StoreItem::class, 'item_id');
    }
}
