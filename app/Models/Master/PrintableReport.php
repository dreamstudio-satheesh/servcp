<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class PrintableReport extends TenantModel
{
    protected $guarded = ['id'];
}
