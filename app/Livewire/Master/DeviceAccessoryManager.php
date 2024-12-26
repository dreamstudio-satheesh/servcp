<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\DeviceAccessory;

class DeviceAccessoryManager extends Component
{
    use WithPagination;

    public $accessoryId;
    public $name;
    public $with_serial_no = false;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'with_serial_no' => 'boolean',
    ];

    public function render()
    {
        $deviceAccessories = DeviceAccessory::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.device-accessory-manager', compact('deviceAccessories'));
    }

    public function resetInputFields()
    {
        $this->accessoryId = null;
        $this->name = '';
        $this->with_serial_no = false;
    }

    public function store()
    {
        $this->validate();

        DeviceAccessory::updateOrCreate(['id' => $this->accessoryId], [
            'name' => $this->name,
            'with_serial_no' => $this->with_serial_no,
        ]);

        session()->flash('message', 'Device Accessory ' . ($this->accessoryId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $accessory = DeviceAccessory::findOrFail($id);
        $this->accessoryId = $accessory->id;
        $this->name = $accessory->name;
        $this->with_serial_no = $accessory->with_serial_no;
    }

    public function delete($id)
    {
        DeviceAccessory::findOrFail($id)->delete();
        session()->flash('message', 'Device Accessory deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
