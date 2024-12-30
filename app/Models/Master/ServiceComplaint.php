<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class ServiceComplaint extends TenantModel
{
    protected $guarded = ['id'];

    public function complaintEstimates()
    {
        return $this->hasMany(ComplaintEstimate::class);
    }
}
