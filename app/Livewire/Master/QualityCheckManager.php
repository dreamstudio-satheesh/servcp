<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\QualityCheck;

class QualityCheckManager extends Component
{
    use WithPagination;

    public $checkId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $qualityChecks = QualityCheck::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.quality-check-manager', compact('qualityChecks'));
    }

    public function resetInputFields()
    {
        $this->checkId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        QualityCheck::updateOrCreate(['id' => $this->checkId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Quality Check ' . ($this->checkId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $check = QualityCheck::findOrFail($id);
        $this->checkId = $check->id;
        $this->name = $check->name;
    }

    public function delete($id)
    {
        QualityCheck::findOrFail($id)->delete();
        session()->flash('message', 'Quality Check deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
