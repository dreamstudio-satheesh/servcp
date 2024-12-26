<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\DeviceBlacklist;
use App\Models\Master\DeviceCompany;
use App\Models\Master\DeviceModel;

class DeviceBlacklistManager extends Component
{
    use WithPagination;

    public $blacklistId;
    public $blacklisted_date;
    public $imei;
    public $company_id;
    public $model_id;
    public $contact_person;
    public $phone;
    public $address;
    public $remarks;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'blacklisted_date' => 'required|date',
        'imei' => 'required|string|max:50',
        'company_id' => 'required|exists:device_companies,id',
        'model_id' => 'required|exists:device_models,id',
        'contact_person' => 'nullable|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'nullable|string|max:500',
        'remarks' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $deviceBlacklists = DeviceBlacklist::with(['company', 'model'])
            ->where('imei', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $deviceCompanies = DeviceCompany::all();
        $deviceModels = DeviceModel::all();

        return view('livewire.master.device-blacklist-manager', compact('deviceBlacklists', 'deviceCompanies', 'deviceModels'));
    }

    public function resetInputFields()
    {
        $this->blacklistId = null;
        $this->blacklisted_date = '';
        $this->imei = '';
        $this->company_id = null;
        $this->model_id = null;
        $this->contact_person = '';
        $this->phone = '';
        $this->address = '';
        $this->remarks = '';
    }

    public function store()
    {
        $this->validate();

        DeviceBlacklist::updateOrCreate(['id' => $this->blacklistId], [
            'blacklisted_date' => $this->blacklisted_date,
            'imei' => $this->imei,
            'company_id' => $this->company_id,
            'model_id' => $this->model_id,
            'contact_person' => $this->contact_person,
            'phone' => $this->phone,
            'address' => $this->address,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Device Blacklist ' . ($this->blacklistId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $blacklist = DeviceBlacklist::findOrFail($id);
        $this->blacklistId = $blacklist->id;
        $this->blacklisted_date = $blacklist->blacklisted_date;
        $this->imei = $blacklist->imei;
        $this->company_id = $blacklist->company_id;
        $this->model_id = $blacklist->model_id;
        $this->contact_person = $blacklist->contact_person;
        $this->phone = $blacklist->phone;
        $this->address = $blacklist->address;
        $this->remarks = $blacklist->remarks;
    }

    public function delete($id)
    {
        DeviceBlacklist::findOrFail($id)->delete();
        session()->flash('message', 'Device Blacklist deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
