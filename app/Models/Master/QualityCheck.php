<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class QualityCheck extends TenantModel
{
    protected $guarded = ['id'];
}
