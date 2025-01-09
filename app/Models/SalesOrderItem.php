<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'price',
        'tax',
        'total',
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'order_id');
    }

    public function item()
    {
        return $this->belongsTo(StoreItem::class, 'item_id');
    }
}
