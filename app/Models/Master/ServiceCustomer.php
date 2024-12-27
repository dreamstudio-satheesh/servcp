<?php

namespace App\Models\Master;


use App\Models\ServiceJob;
use Illuminate\Database\Eloquent\Model;

class ServiceCustomer extends Model
{
    protected $guarded = ['id'];


    public function jobs()
    {
        // If there's a 'service_jobs' table referencing customer_id
        return $this->hasMany(ServiceJob::class, 'customer_id');
    }
}
