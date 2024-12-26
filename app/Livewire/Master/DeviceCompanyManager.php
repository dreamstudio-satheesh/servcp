<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\DeviceCompany;

class DeviceCompanyManager extends Component
{
    use WithPagination;

    public $companyId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $deviceCompanies = DeviceCompany::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.device-company-manager', compact('deviceCompanies'));
    }

    public function resetInputFields()
    {
        $this->companyId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        DeviceCompany::updateOrCreate(['id' => $this->companyId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Device Company ' . ($this->companyId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $company = DeviceCompany::findOrFail($id);
        $this->companyId = $company->id;
        $this->name = $company->name;
    }

    public function delete($id)
    {
        DeviceCompany::findOrFail($id)->delete();
        session()->flash('message', 'Device Company deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
