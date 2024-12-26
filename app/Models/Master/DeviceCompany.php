<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DeviceCompany extends Model
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
