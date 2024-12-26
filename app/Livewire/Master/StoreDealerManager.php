<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\StoreDealer;

class StoreDealerManager extends Component
{
    use WithPagination;

    public $dealerId;
    public $name;
    public $phone;
    public $email;
    public $place;
    public $gst_number;
    public $opening_balance;
    public $address;
    public $other_information;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'place' => 'nullable|string|max:255',
        'gst_number' => 'nullable|string|max:50',
        'opening_balance' => 'nullable|numeric|min:0',
        'address' => 'nullable|string|max:500',
        'other_information' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $storeDealers = StoreDealer::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.store-dealer-manager', compact('storeDealers'));
    }

    public function resetInputFields()
    {
        $this->dealerId = null;
        $this->name = '';
        $this->phone = '';
        $this->email = '';
        $this->place = '';
        $this->gst_number = '';
        $this->opening_balance = null;
        $this->address = '';
        $this->other_information = '';
    }

    public function store()
    {
        $this->validate();

        StoreDealer::updateOrCreate(['id' => $this->dealerId], [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'place' => $this->place,
            'gst_number' => $this->gst_number,
            'opening_balance' => $this->opening_balance,
            'address' => $this->address,
            'other_information' => $this->other_information,
        ]);

        session()->flash('message', 'Store Dealer ' . ($this->dealerId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $dealer = StoreDealer::findOrFail($id);
        $this->dealerId = $dealer->id;
        $this->name = $dealer->name;
        $this->phone = $dealer->phone;
        $this->email = $dealer->email;
        $this->place = $dealer->place;
        $this->gst_number = $dealer->gst_number;
        $this->opening_balance = $dealer->opening_balance;
        $this->address = $dealer->address;
        $this->other_information = $dealer->other_information;
    }

    public function delete($id)
    {
        StoreDealer::findOrFail($id)->delete();
        session()->flash('message', 'Store Dealer deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
