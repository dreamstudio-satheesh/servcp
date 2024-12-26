<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\DeviceModel;
use App\Models\Master\DeviceCompany;

class DeviceModelManager extends Component
{
    use WithPagination;

    public $modelId;
    public $company_id;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'company_id' => 'required|exists:device_companies,id',
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $deviceModels = DeviceModel::with('company')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $deviceCompanies = DeviceCompany::all();

        return view('livewire.master.device-model-manager', compact('deviceModels', 'deviceCompanies'));
    }

    public function resetInputFields()
    {
        $this->modelId = null;
        $this->company_id = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        DeviceModel::updateOrCreate(['id' => $this->modelId], [
            'company_id' => $this->company_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Device Model ' . ($this->modelId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $model = DeviceModel::findOrFail($id);
        $this->modelId = $model->id;
        $this->company_id = $model->company_id;
        $this->name = $model->name;
    }

    public function delete($id)
    {
        DeviceModel::findOrFail($id)->delete();
        session()->flash('message', 'Device Model deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
