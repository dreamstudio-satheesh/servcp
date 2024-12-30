<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class DeviceCompany extends TenantModel
{
    protected $guarded = ['id'];

    public function deviceModels()
    {
        return $this->hasMany(DeviceModel::class, 'company_id');
    }

    public function blacklists()
    {
        return $this->hasMany(DeviceBlacklist::class, 'company_id');
    }
}
