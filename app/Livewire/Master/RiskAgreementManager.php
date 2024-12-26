<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\RiskAgreement;

class RiskAgreementManager extends Component
{
    use WithPagination;

    public $agreementId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $riskAgreements = RiskAgreement::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.risk-agreement-manager', compact('riskAgreements'));
    }

    public function resetInputFields()
    {
        $this->agreementId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        RiskAgreement::updateOrCreate(['id' => $this->agreementId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Risk Agreement ' . ($this->agreementId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $agreement = RiskAgreement::findOrFail($id);
        $this->agreementId = $agreement->id;
        $this->name = $agreement->name;
    }

    public function delete($id)
    {
        RiskAgreement::findOrFail($id)->delete();
        session()->flash('message', 'Risk Agreement deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
