<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\ComplaintEstimate;
use App\Models\Master\ServiceComplaint;

class ComplaintEstimateManager extends Component
{
    use WithPagination;

    public $estimateId;
    public $service_complaint_id;
    public $estimate_amount;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'service_complaint_id' => 'required|exists:service_complaints,id',
        'estimate_amount' => 'required|numeric|min:0',
    ];

    public function render()
    {
        $complaintEstimates = ComplaintEstimate::with('serviceComplaint')
            ->whereHas('serviceComplaint', function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        $serviceComplaints = ServiceComplaint::all();

        return view('livewire.master.complaint-estimate-manager', compact('complaintEstimates', 'serviceComplaints'));
    }

    public function resetInputFields()
    {
        $this->estimateId = null;
        $this->service_complaint_id = null;
        $this->estimate_amount = null;
    }

    public function store()
    {
        $this->validate();

        ComplaintEstimate::updateOrCreate(['id' => $this->estimateId], [
            'service_complaint_id' => $this->service_complaint_id,
            'estimate_amount' => $this->estimate_amount,
        ]);

        session()->flash('message', 'Complaint Estimate ' . ($this->estimateId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $estimate = ComplaintEstimate::findOrFail($id);
        $this->estimateId = $estimate->id;
        $this->service_complaint_id = $estimate->service_complaint_id;
        $this->estimate_amount = $estimate->estimate_amount;
    }

    public function delete($id)
    {
        ComplaintEstimate::findOrFail($id)->delete();
        session()->flash('message', 'Complaint Estimate deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
