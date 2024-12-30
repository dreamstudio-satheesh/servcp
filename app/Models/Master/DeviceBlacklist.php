<?php

namespace App\Models\Master;

use App\Models\TenantModel;
use Illuminate\Database\Eloquent\Model;

class DeviceBlacklist extends TenantModel
{
    protected $guarded = ['id'];

    /**
     * Get the company associated with the blacklist entry.
     */
    public function company()
    {
        return $this->belongsTo(DeviceCompany::class, 'company_id');
    }

    /**
     * Get the device model associated with the blacklist entry.
     */
    public function model()
    {
        return $this->belongsTo(DeviceModel::class, 'model_id');
    }
}
