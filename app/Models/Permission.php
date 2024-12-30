<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends TenantModel
{
    protected $fillable = ['name', 'description'];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permissions'); // Specify pivot table name
    }

    
}
