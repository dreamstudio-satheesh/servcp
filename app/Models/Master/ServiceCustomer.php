<?php

namespace App\Models\Master;


use App\Models\ServiceJob;
use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class ServiceCustomer extends TenantModel
{
    protected $fillable = [
        'name', 'phone', 'place', 'username', 'password', 'email',
        'gst_number', 'opening_balance', 'address', 'remarks', 'customer_type'
    ];
    


    public function jobs()
    {
        // If there's a 'service_jobs' table referencing customer_id
        return $this->hasMany(ServiceJob::class, 'customer_id');
    }
}
