<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\ServiceComplaint;

class ServiceComplaintManager extends Component
{
    use WithPagination;

    public $complaintId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $serviceComplaints = ServiceComplaint::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.service-complaint-manager', compact('serviceComplaints'));
    }

    public function resetInputFields()
    {
        $this->complaintId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        ServiceComplaint::updateOrCreate(['id' => $this->complaintId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Service Complaint ' . ($this->complaintId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $complaint = ServiceComplaint::findOrFail($id);
        $this->complaintId = $complaint->id;
        $this->name = $complaint->name;
    }

    public function delete($id)
    {
        ServiceComplaint::findOrFail($id)->delete();
        session()->flash('message', 'Service Complaint deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
