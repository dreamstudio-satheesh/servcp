<?php

namespace App\Livewire\JobEntry;

use Livewire\Component;
use App\Models\ServiceJob;
use App\Models\Master\DeviceModel;
use App\Models\Master\DeviceCompany;

class General extends Component
{
    public $customerId;

    public $jobNumber;

    protected $listeners = ['customerIdUpdated'];

    public $selectedCompany = null;
    public $companies = [];
    public $brandModels = [];
    

    private function generateJobNumber()
    {
        $lastJob = ServiceJob::latest('id')->first();
        $lastNumber = $lastJob ? intval(str_replace('RVM', '', $lastJob->job_number)) : 0;
        $this->jobNumber = 'RVM-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }



    public function loadCompanies()
    {
        $this->companies = DeviceCompany::select('id', 'name')->get();
    }

    public function updatedSelectedCompany($companyId)
    {
        // Handle the selected company logic if needed
        $this->selectedCompany = $companyId;

         // Fetch brand models for the selected company
         $this->brandModels = DeviceModel::where('company_id', $companyId)->get();
    }



    public function mount()
    {
        $this->generateJobNumber();

        $this->loadCompanies();
    }


    public function customerIdUpdated($customerId)
    {
        $this->customerId = $customerId;
    }

    

    

    public function render()
    {
        return view('livewire.job-entry.general');
    }
}