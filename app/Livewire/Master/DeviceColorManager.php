<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\DeviceColor;

class DeviceColorManager extends Component
{
    use WithPagination;

    public $colorId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $deviceColors = DeviceColor::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.device-color-manager', compact('deviceColors'));
    }

    public function resetInputFields()
    {
        $this->colorId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        DeviceColor::updateOrCreate(['id' => $this->colorId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Device Color ' . ($this->colorId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $color = DeviceColor::findOrFail($id);
        $this->colorId = $color->id;
        $this->name = $color->name;
    }

    public function delete($id)
    {
        DeviceColor::findOrFail($id)->delete();
        session()->flash('message', 'Device Color deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
