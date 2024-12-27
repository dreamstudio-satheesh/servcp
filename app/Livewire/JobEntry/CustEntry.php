<?php

namespace App\Livewire\JobEntry;

use Livewire\Component;
use App\Models\Master\ServiceCustomer;

class CustEntry extends Component
{
    // Search box input
    public $searchTerm = '';

    // Search results from DB
    public $searchResults = [];

    // Selected customer info
    public $customerId;
    public $customer_type = 'Customer';
    public $phone;
    public $name;
    public $place;
    public $email;
    public $address;

    // Previous jobs
    public $previousJobs = [];

    // Validation rules
    protected $rules = [
        'phone' => 'required',
        'name' => 'required',
        'customer_type' => 'required',
        'email' => 'nullable|email',
        // ...
    ];

    /**
     * Runs whenever $searchTerm is updated.
     * We fetch customers matching name / phone / email.
     */
    public function updatedSearchTerm($value)
    {
        // If the user clears the searchTerm, clear the list
        if (empty($value)) {
            $this->searchResults = [];
            return;
        }

        // Otherwise, fetch from DB (limit to avoid huge responses)
        $this->searchResults = ServiceCustomer::query()
            ->where('phone', 'like', '%' . $value . '%')
            ->orWhere('name', 'like', '%' . $value . '%')
            ->orWhere('email', 'like', '%' . $value . '%')
            ->limit(5)
            ->get();
    }

    /**
     * Called when the user clicks on a particular search result.
     * We load the selected customer's details & previous jobs.
     */
    public function selectCustomer($customerId)
    {
        // Clear search results
        $this->searchResults = [];
        $this->searchTerm = '';

        $customer = ServiceCustomer::find($customerId);
        if ($customer) {
            $this->customerId = $customer->id;
            $this->phone      = $customer->phone;
            $this->place      = $customer->place;
            $this->name       = $customer->name;
            $this->customer_type = $customer->customer_type;
            $this->email      = $customer->email;
            $this->address    = $customer->address;

            // Load previous jobs (assuming relationship or separate query)
            $this->previousJobs = $customer->jobs()->orderBy('entry_date_time', 'desc')->get();
        }

        $this->dispatch('updateCustomerId', $customer->id);
    }

    /**
     * Submit the form: validate and save or update customer info.
     */
    public function submitForm()
    {
        $this->validate();

        // If there's an existing customerId, update; otherwise create
        $customer = ServiceCustomer::updateOrCreate(
            ['id' => $this->customerId],  // match by ID if it exists
            [
                'phone'   => $this->phone,
                'name'    => $this->name,
                'customer_type'=> $this->customer_type,
                'place'   => $this->place,
                'email'   => $this->email,
                'address' => $this->address,
            ]
        );

        // If newly created, set the ID
        if ($customer) {
            $this->customerId = $customer->id;
            $this->dispatch('updateCustomerId', $customer->id);
            session()->flash('message', 'Customer data saved!');
        }
        else{
            session()->flash('message', 'Something wrong to create customer!');
        }
        

       
    }

    public function render()
    {
        return view('livewire.job-entry.cust-entry');
    }
}
