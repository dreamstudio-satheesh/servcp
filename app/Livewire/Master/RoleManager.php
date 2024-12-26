<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;

class RoleManager extends Component
{
    use WithPagination;

    public $roleId;
    public $name;
    public $description;
    public $session_time_minutes;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'session_time_minutes' => 'nullable|integer|min:0',
    ];

    public function render()
    {
        $roles = Role::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.role-manager', compact('roles'));
    }

    public function resetInputFields()
    {
        $this->roleId = null;
        $this->name = '';
        $this->description = '';
        $this->session_time_minutes = '';
    }

    public function store()
    {
        $this->validate();

        Role::updateOrCreate(['id' => $this->roleId], [
            'name' => $this->name,
            'description' => $this->description,
            'session_time_minutes' => $this->session_time_minutes,
        ]);

        session()->flash('message', 'Role ' . ($this->roleId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->description = $role->description;
        $this->session_time_minutes = $role->session_time_minutes;
    }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
        session()->flash('message', 'Role deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
