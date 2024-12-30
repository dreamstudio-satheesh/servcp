<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class DeviceAccessory extends TenantModel
{
    protected $guarded = ['id'];
}
