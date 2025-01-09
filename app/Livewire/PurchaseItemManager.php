<?php

namespace App\Livewire;

use Livewire\Component;

class PurchaseItemManager extends Component
{
    public $showForm = false;
    public $purchaseItemId = null;

    protected $listeners = [
        'showForm' => 'openForm',
        'hideForm' => 'closeForm',
    ];

    public function openForm($id = null)
    {
        $this->purchaseItemId = $id;
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
        $this->purchaseItemId = null;
    }

    public function render()
    {
        return view('livewire.purchase-item-manager');
    }
}
