<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\PrintableReport;

class PrintableReportManager extends Component
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
        $printableReports = PrintableReport::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.printable-report-manager', compact('printableReports'));
    }

    public function resetInputFields()
    {
        $this->reportId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        PrintableReport::updateOrCreate(['id' => $this->reportId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Printable Report ' . ($this->reportId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $report = PrintableReport::findOrFail($id);
        $this->reportId = $report->id;
        $this->name = $report->name;
    }

    public function delete($id)
    {
        PrintableReport::findOrFail($id)->delete();
        session()->flash('message', 'Printable Report deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
