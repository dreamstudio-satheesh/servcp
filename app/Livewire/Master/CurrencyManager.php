<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\Currency;

class CurrencyManager extends Component
{
    use WithPagination;

    public $currencyId;
    public $name;
    public $symbol;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'symbol' => 'required|string|max:10',
    ];

    public function render()
    {
        $currencies = Currency::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.currency-manager', compact('currencies'));
    }

    public function resetInputFields()
    {
        $this->currencyId = null;
        $this->name = '';
        $this->symbol = '';
    }

    public function store()
    {
        $this->validate();

        Currency::updateOrCreate(['id' => $this->currencyId], [
            'name' => $this->name,
            'symbol' => $this->symbol,
        ]);

        session()->flash('message', 'Currency ' . ($this->currencyId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        $this->currencyId = $currency->id;
        $this->name = $currency->name;
        $this->symbol = $currency->symbol;
    }

    public function delete($id)
    {
        Currency::findOrFail($id)->delete();
        session()->flash('message', 'Currency deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
