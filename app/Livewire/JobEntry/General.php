<?php

namespace App\Livewire\JobEntry;

use Livewire\Component;

class General extends Component
{
    public $customerId;

    protected $listeners = ['customerIdUpdated'];

    public function customerIdUpdated($customerId)
    {
        $this->customerId = $customerId;
    }

    

    

    public function render()
    {
        return view('livewire.job-entry.general');
    }
}
