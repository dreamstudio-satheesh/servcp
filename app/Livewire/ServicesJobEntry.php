<?php

namespace App\Livewire;

use Livewire\Component;

class ServicesJobEntry extends Component
{   
    public $customerId;

    protected $listeners = ['updateCustomerId'];

    public function updateCustomerId($customerId)
    {
        $this->customerId = $customerId;
        $this->dispatch('customerIdUpdated', $customerId); // Dispatch event for the sibling
        
    }

   

    public function render()
    {
        return view('livewire.services-job-entry');
    }
}
