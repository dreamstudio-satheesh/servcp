<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\DevicePhysicalCondition;

class DevicePhysicalConditionManager extends Component
{
    use WithPagination;

    public $conditionId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $devicePhysicalConditions = DevicePhysicalCondition::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.device-physical-condition-manager', compact('devicePhysicalConditions'));
    }

    public function resetInputFields()
    {
        $this->conditionId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        DevicePhysicalCondition::updateOrCreate(['id' => $this->conditionId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Device Physical Condition ' . ($this->conditionId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $condition = DevicePhysicalCondition::findOrFail($id);
        $this->conditionId = $condition->id;
        $this->name = $condition->name;
    }

    public function delete($id)
    {
        DevicePhysicalCondition::findOrFail($id)->delete();
        session()->flash('message', 'Device Physical Condition deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
