<?php

namespace App\Models;

use App\Models\Master\DeviceColor;
use App\Models\Master\DeviceModel;
use App\Models\Master\DeviceCompany;
use App\Models\Master\RiskAgreement;
use App\Models\Master\DeviceAccessory;
use App\Models\Master\ServiceCustomer;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\DevicePhysicalCondition;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceJob extends Model
{
    use HasFactory;

    protected $table = 'service_jobs'; // Updated to follow Laravel naming conventions

    protected $fillable = [
        'job_number',
        'customer_id',
        'device_company_id',
        'device_model_id',
        'device_color_id',
        'entry_date_time',
        'reference_number',
        'warranty_status',
        'imei_serial',
        'device_password',
        'provider_info',
        'complaint_details',
        'other_remarks',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(ServiceCustomer::class);
    }

    public function deviceCompany()
    {
        return $this->belongsTo(DeviceCompany::class);
    }

    public function deviceModel()
    {
        return $this->belongsTo(DeviceModel::class);
    }

    public function deviceColor()
    {
        return $this->belongsTo(DeviceColor::class);
    }

    public function physicalConditions()
    {
        return $this->belongsToMany(DevicePhysicalCondition::class, 'service_job_physical_conditions');
    }

    public function riskAgreements()
    {
        return $this->belongsToMany(RiskAgreement::class, 'service_job_risk_agreements');
    }

    public function accessories()
    {
        return $this->belongsToMany(DeviceAccessory::class, 'service_job_accessories');
    }

    public function initialChecks()
    {
        return $this->hasOne(ServiceJobInitialCheck::class);
    }
}
