<?php

namespace App\Livewire\JobEntry;

use Livewire\Component;
use App\Models\ServiceJob;
use App\Models\Master\DeviceCompany;
use App\Models\Master\DeviceModel;
use Carbon\Carbon;

class General extends Component
{
    public $jobNumber;
    public $entryDate;
    public $referenceNumber;
    public $warrantyStatus = 'Out of Warranty';
    public $selectedCompany;
    public $selectedModel;
    public $imeiSerial;
    public $devicePassword;
    public $providerInfo;
    public $complaintDetails;
    public $otherRemarks;

    public $companies = [];
    public $models = [];

    protected $rules = [
        'entryDate' => 'required|date',
        'selectedCompany' => 'required|exists:device_companies,id',
        'selectedModel' => 'required|exists:device_models,id',
        'imeiSerial' => 'required|string|max:15|unique:service_jobs,imei_serial',
        'devicePassword' => 'required|string',
        'complaintDetails' => 'required|string',
        'referenceNumber' => 'nullable|string',
        'providerInfo' => 'nullable|string',
        'otherRemarks' => 'nullable|string',
    ];

    public function mount()
    {
        $this->generateJobNumber();
        $this->entryDate = Carbon::now()->toDateString();
        $this->loadCompanies();
    }

    public function generateJobNumber()
    {
        $lastJob = ServiceJob::latest('id')->first();
        $lastNumber = $lastJob ? intval(str_replace('RVM-', '', $lastJob->job_number)) : 0;
        $this->jobNumber = 'RVM-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }

    public function loadCompanies()
    {
        $this->companies = DeviceCompany::select('id', 'name')->get();
    }

    public function updatedSelectedCompany($companyId)
    {
        $this->models = DeviceModel::where('company_id', $companyId)->get();
    }

    public function save()
    {
        $this->validate();

        ServiceJob::create([
            'job_number' => $this->jobNumber,
            'customer_id' => 1, // Replace with actual customer ID logic
            'device_company_id' => $this->selectedCompany,
            'device_model_id' => $this->selectedModel,
            'entry_date_time' => $this->entryDate,
            'reference_number' => $this->referenceNumber,
            'warranty_status' => $this->warrantyStatus,
            'imei_serial' => $this->imeiSerial,
            'device_password' => $this->devicePassword,
            'provider_info' => $this->providerInfo,
            'complaint_details' => $this->complaintDetails,
            'other_remarks' => $this->otherRemarks,
        ]);

        session()->flash('message', 'Job saved successfully!');
    }

    public function render()
    {
        return view('livewire.job-entry.general');
    }
}
