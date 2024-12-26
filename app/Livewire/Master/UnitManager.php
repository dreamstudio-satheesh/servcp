<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\Unit;

class UnitManager extends Component
{
    use WithPagination;

    public $unitId;
    public $name;
    public $abbreviation;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'abbreviation' => 'required|string|max:10',
    ];

    public function render()
    {
        $units = Unit::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('abbreviation', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.unit-manager', compact('units'));
    }

    public function resetInputFields()
    {
        $this->unitId = null;
        $this->name = '';
        $this->abbreviation = '';
    }

    public function store()
    {
        $this->validate();

        Unit::updateOrCreate(['id' => $this->unitId], [
            'name' => $this->name,
            'abbreviation' => $this->abbreviation,
        ]);

        session()->flash('message', 'Unit ' . ($this->unitId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        $this->unitId = $unit->id;
        $this->name = $unit->name;
        $this->abbreviation = $unit->abbreviation;
    }

    public function delete($id)
    {
        Unit::findOrFail($id)->delete();
        session()->flash('message', 'Unit deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
