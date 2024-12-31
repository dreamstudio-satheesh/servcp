<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceJobInitialCheck extends TenantModel
{
    protected $table = 'services_job_initial_checks';

    use HasFactory;

    protected $fillable = [
        'service_job_id',
        'display_status',
        'back_panel_status',
        'device_status',
        // Add additional fields as needed for initial checks
    ];

    public function serviceJob()
    {
        return $this->belongsTo(ServiceJob::class);
    }
}
