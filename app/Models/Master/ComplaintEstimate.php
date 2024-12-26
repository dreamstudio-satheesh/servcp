<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class ComplaintEstimate extends Model
{
    protected $guarded = ['id'];

    public function serviceComplaint()
    {
        return $this->belongsTo(ServiceComplaint::class);
    }
}
