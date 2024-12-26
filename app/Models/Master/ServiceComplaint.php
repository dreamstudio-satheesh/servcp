<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class ServiceComplaint extends Model
{
    protected $guarded = ['id'];

    public function complaintEstimates()
    {
        return $this->hasMany(ComplaintEstimate::class);
    }
}
