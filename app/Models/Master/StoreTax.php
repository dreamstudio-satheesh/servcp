<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class StoreTax extends TenantModel
{
    protected $guarded = ['id'];
}
