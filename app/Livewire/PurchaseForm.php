<?php

namespace App\Livewire;


use App\Models\User;
use Livewire\Component;
use App\Models\Master\Vendor;

class PurchaseForm extends Component
{
    public $purchase_no, $reference_no, $vendor_id, $salesman_id, $remarks;
    public $items = [];
    public $discount = 0, $courier_cost = 0, $total_cost = 0;

    public $vendors, $salesmen;

    public function mount()
    {
        $this->vendors = Vendor::all();
        $this->salesmen = User::all();
    }

    public function addItem()
    {
        $this->items[] = [
            'item_code' => '',
            'item_name' => '',
            'purchase_cost' => 0,
            'quantity' => 1,
            'tax' => 0,
            'total' => 0,
        ];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total_cost = collect($this->items)->sum('total') + $this->courier_cost - $this->discount;
    }

    public function save()
    {
        // Validation and saving logic here
        session()->flash('message', 'Purchase saved successfully!');
    }

    public function resetForm()
    {
        $this->reset();
        $this->mount();
    }

    public function render()
    {
        return view('livewire.purchase-form');
    }
}
