<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class ComplaintEstimate extends TenantModel
{
    protected $guarded = ['id'];

    public function serviceComplaint()
    {
        return $this->belongsTo(ServiceComplaint::class);
    }
}
