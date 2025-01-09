<?php

namespace App\Models;

use App\Models\Master\ServiceCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'customer_id',
        'order_date',
        'remarks',
        'total_amount',
        'discount',
        'tax',
        'net_amount',
        'status',
        'salesman_id',
    ];

    public function customer()
    {
        return $this->belongsTo(ServiceCustomer::class, 'customer_id');
    }

    public function salesman()
    {
        return $this->belongsTo(User::class, 'salesman_id');
    }

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class, 'order_id');
    }

    public function sale()
    {
        return $this->hasOne(Sale::class, 'sales_order_id');
    }
}
