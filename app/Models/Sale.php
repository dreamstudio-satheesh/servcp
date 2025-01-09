<?php


namespace App\Models;

use App\Models\Master\ServiceCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'reference_no',
        'customer_id',
        'salesman_id',
        'sale_date',
        'remarks',
        'total_amount',
        'discount',
        'tax',
        'net_amount',
        'sales_order_id',
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
        return $this->hasMany(SalesItem::class, 'sale_id');
    }

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class, 'sales_order_id');
    }
}
