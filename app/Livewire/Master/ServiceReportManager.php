<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\ServiceReport;

class ServiceReportManager extends Component
{
    use WithPagination;

    public $reportId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $serviceReports = ServiceReport::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.service-report-manager', compact('serviceReports'));
    }

    public function resetInputFields()
    {
        $this->reportId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        ServiceReport::updateOrCreate(['id' => $this->reportId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Service Report ' . ($this->reportId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $report = ServiceReport::findOrFail($id);
        $this->reportId = $report->id;
        $this->name = $report->name;
    }

    public function delete($id)
    {
        ServiceReport::findOrFail($id)->delete();
        session()->flash('message', 'Service Report deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
