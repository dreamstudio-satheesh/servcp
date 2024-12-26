<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;
use App\Models\Permission;

class UserPrivileges extends Component
{
    public $roles;
    public $selectedRole = null;
    public $permissions = [];
    public $rolePermissions = [];

    public function mount()
    {
        // Fetch all roles to populate the dropdown
        $this->roles = Role::all();

        // Set the default selected role
        $this->selectedRole = $this->roles->first()?->id;

        // Load permissions for the selected role
        if ($this->selectedRole) {
            $this->loadPermissions();
        }
    }

    public function loadPermissions()
    {
        // Fetch all available permissions
        $this->permissions = Permission::all();

        // Fetch permissions assigned to the selected role
        $this->rolePermissions = Role::find($this->selectedRole)?->permissions->pluck('id')->toArray() ?? [];
    }

    public function updatedSelectedRole($value)
    {
        // Fetch permissions for the selected role
        $this->rolePermissions = Role::find($value)?->permissions->pluck('id')->toArray() ?? [];
        $this->permissions = Permission::all();
    }

    public function updatePrivileges()
    {
        // Update role permissions in the database
        $role = Role::findOrFail($this->selectedRole);
        $role->permissions()->sync($this->rolePermissions);

        session()->flash('success', 'Privileges updated successfully.');
    }

    public function render()
    {
        return view('livewire.user-privileges');
    }
}
