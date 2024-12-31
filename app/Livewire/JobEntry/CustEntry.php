<?php

namespace App\Livewire\JobEntry;

use Livewire\Component;
use App\Models\Master\ServiceCustomer;

class CustEntry extends Component
{
    public $searchTerm = '';
    public $searchResults = [];
    public $customerId;
    public $customer_type = 'Customer';
    public $phone;
    public $name;
    public $place;
    public $email;
    public $address;
    public $previousJobs = [];

    protected $rules = [
        'phone' => 'required',
        'name' => 'required',
        'customer_type' => 'required',
        'email' => 'nullable|email',
    ];

    public function updatedSearchTerm($value)
    {
        if (empty($value)) {
            $this->searchResults = [];
            return;
        }

        $this->searchResults = ServiceCustomer::query()
            ->where('phone', 'like', '%' . $value . '%')
            ->orWhere('name', 'like', '%' . $value . '%')
            ->orWhere('email', 'like', '%' . $value . '%')
            ->limit(5)
            ->get();
    }

    public function selectCustomer($customerId)
    {
        $this->searchResults = [];
        $this->searchTerm = '';

        $customer = ServiceCustomer::find($customerId);
        if ($customer) {
            $this->customerId = $customer->id;
            $this->phone = $customer->phone;
            $this->place = $customer->place;
            $this->name = $customer->name;
            $this->customer_type = $customer->customer_type;
            $this->email = $customer->email;
            $this->address = $customer->address;

            $this->previousJobs = $customer->jobs()->orderBy('entry_date_time', 'desc')->get();
        }

        $this->dispatch('updateCustomerId', [$customer->id]);
    }

    public function submitForm()
    {
        $this->validate();

        $customer = ServiceCustomer::updateOrCreate(
            ['id' => $this->customerId],
            [
                'phone' => $this->phone,
                'name' => $this->name,
                'customer_type' => $this->customer_type,
                'place' => $this->place,
                'email' => $this->email,
                'address' => $this->address,
            ]
        );

        if ($customer) {
            $this->customerId = $customer->id;
            $this->dispatch('updateCustomerId', id: $customer->id);
            session()->flash('message', 'Customer data saved successfully!');
        } else {
            session()->flash('error', 'Failed to save customer data.');
        }
    }

    public function mount($customerId = null)
    {
        $this->customerId = $customerId; // Initialize with parent's customerId
    }

    public function render()
    {
        return view('livewire.job-entry.cust-entry');
    }
}
