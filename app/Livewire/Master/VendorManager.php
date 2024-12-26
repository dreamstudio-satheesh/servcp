<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\Vendor;

class VendorManager extends Component
{
    use WithPagination;

    public $vendorId;
    public $name;
    public $contact_person;
    public $phone;
    public $place;
    public $email;
    public $gst_number;
    public $opening_balance;
    public $address;
    public $remarks;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'contact_person' => 'nullable|string|max:255',
        'phone' => 'required|string|max:20',
        'place' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'gst_number' => 'nullable|string|max:50',
        'opening_balance' => 'nullable|numeric|min:0',
        'address' => 'nullable|string|max:500',
        'remarks' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $vendors = Vendor::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.vendor-manager', compact('vendors'));
    }

    public function resetInputFields()
    {
        $this->vendorId = null;
        $this->name = '';
        $this->contact_person = '';
        $this->phone = '';
        $this->place = '';
        $this->email = '';
        $this->gst_number = '';
        $this->opening_balance = null;
        $this->address = '';
        $this->remarks = '';
    }

    public function store()
    {
        $this->validate();

        Vendor::updateOrCreate(['id' => $this->vendorId], [
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'phone' => $this->phone,
            'place' => $this->place,
            'email' => $this->email,
            'gst_number' => $this->gst_number,
            'opening_balance' => $this->opening_balance,
            'address' => $this->address,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Vendor ' . ($this->vendorId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);
        $this->vendorId = $vendor->id;
        $this->name = $vendor->name;
        $this->contact_person = $vendor->contact_person;
        $this->phone = $vendor->phone;
        $this->place = $vendor->place;
        $this->email = $vendor->email;
        $this->gst_number = $vendor->gst_number;
        $this->opening_balance = $vendor->opening_balance;
        $this->address = $vendor->address;
        $this->remarks = $vendor->remarks;
    }

    public function delete($id)
    {
        Vendor::findOrFail($id)->delete();
        session()->flash('message', 'Vendor deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
