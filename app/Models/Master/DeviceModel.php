<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class DeviceModel extends Model
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
