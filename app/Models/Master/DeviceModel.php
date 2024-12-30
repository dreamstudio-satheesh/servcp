<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class DeviceModel extends TenantModel
{
    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo(DeviceCompany::class, 'company_id');
    }

    public function blacklists()
    {
        return $this->hasMany(DeviceBlacklist::class, 'model_id');
    }
}
