<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\StoreTax;

class StoreTaxManager extends Component
{
    use WithPagination;

    public $taxId;
    public $name;
    public $rate;
    public $type;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'rate' => 'required|numeric|min:0|max:100',
        'type' => 'required|in:inclusive,exclusive',
    ];

    public function render()
    {
        $storeTaxes = StoreTax::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.store-tax-manager', compact('storeTaxes'));
    }

    public function resetInputFields()
    {
        $this->taxId = null;
        $this->name = '';
        $this->rate = null;
        $this->type = '';
    }

    public function store()
    {
        $this->validate();

        StoreTax::updateOrCreate(['id' => $this->taxId], [
            'name' => $this->name,
            'rate' => $this->rate,
            'type' => $this->type,
        ]);

        session()->flash('message', 'Store Tax ' . ($this->taxId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $tax = StoreTax::findOrFail($id);
        $this->taxId = $tax->id;
        $this->name = $tax->name;
        $this->rate = $tax->rate;
        $this->type = $tax->type;
    }

    public function delete($id)
    {
        StoreTax::findOrFail($id)->delete();
        session()->flash('message', 'Store Tax deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
