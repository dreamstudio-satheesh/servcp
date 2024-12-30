<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends TenantModel
{
    protected $fillable = ['name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions'); // Specify pivot table name
    }
}
