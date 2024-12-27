<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\ServiceCustomer;

class ServiceCustomerManager extends Component
{
    use WithPagination;

    public $customerId;
    public $name;
    public $phone;
    public $customer_type = 'Customer';
    public $place;
    public $username;
    public $password;
    public $email;
    public $gst_number;
    public $opening_balance;
    public $address;
    public $remarks;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'customer_type' => 'required|in:Customer,Dealer',
        'username' => 'nullable|string|max:255|unique:service_customers,username',
        'password' => 'nullable|string|min:6',
        'email' => 'nullable|email|max:255',
        'gst_number' => 'nullable|string|max:50',
        'opening_balance' => 'nullable|numeric|min:0',
        'address' => 'nullable|string|max:500',
        'remarks' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $serviceCustomers = ServiceCustomer::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.service-customer-manager', compact('serviceCustomers'));
    }

    public function resetInputFields()
    {
        $this->customerId = null;
        $this->name = '';
        $this->phone = '';
        $this->customer_type = 'Customer';
        $this->place = '';
        $this->username = '';
        $this->password = '';
        $this->email = '';
        $this->gst_number = '';
        $this->opening_balance = null;
        $this->address = '';
        $this->remarks = '';
    }

    public function store()
    {
        $this->validate();

        ServiceCustomer::updateOrCreate(['id' => $this->customerId], [
            'name' => $this->name,
            'phone' => $this->phone,
            'customer_type' => $this->customer_type,
            'place' => $this->place,
            'username' => $this->username,
            'password' => bcrypt($this->password),
            'email' => $this->email,
            'gst_number' => $this->gst_number,
            'opening_balance' => $this->opening_balance,
            'address' => $this->address,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Service Customer ' . ($this->customerId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $customer = ServiceCustomer::findOrFail($id);
        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->phone = $customer->phone;
        $this->customer_type = $customer->customer_type;
        $this->place = $customer->place;
        $this->username = $customer->username;
        $this->password = ''; // Password not editable directly
        $this->email = $customer->email;
        $this->gst_number = $customer->gst_number;
        $this->opening_balance = $customer->opening_balance;
        $this->address = $customer->address;
        $this->remarks = $customer->remarks;
    }

    public function delete($id)
    {
        ServiceCustomer::findOrFail($id)->delete();
        session()->flash('message', 'Service Customer deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
