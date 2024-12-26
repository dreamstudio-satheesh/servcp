<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\InitialCheck;

class InitialCheckManager extends Component
{
    use WithPagination;

    public $checkId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $initialChecks = InitialCheck::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.initial-check-manager', compact('initialChecks'));
    }

    public function resetInputFields()
    {
        $this->checkId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        InitialCheck::updateOrCreate(['id' => $this->checkId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Initial Check ' . ($this->checkId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $check = InitialCheck::findOrFail($id);
        $this->checkId = $check->id;
        $this->name = $check->name;
    }

    public function delete($id)
    {
        InitialCheck::findOrFail($id)->delete();
        session()->flash('message', 'Initial Check deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
