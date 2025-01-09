<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Master\Vendor;
use App\Models\StoreItem;

class PurchaseForm extends Component
{
    public $purchase_no, $reference_no, $vendor_id, $salesman_id, $remarks;
    public $items = [];
    public $discount = 0, $courier_cost = 0, $total_cost = 0;
    public $vendors, $salesmen, $searchQuery, $filteredItems;

    protected $rules = [
        'purchase_no' => 'required|string|max:255',
        'vendor_id' => 'required|exists:vendors,id',
        'salesman_id' => 'nullable|exists:users,id',
        'items.*.item_id' => 'required|exists:store_items,id',
        'items.*.purchase_cost' => 'required|numeric|min:0',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.tax' => 'nullable|numeric|min:0',
    ];

    public function mount()
    {
        $this->vendors = Vendor::all();
        $this->salesmen = User::all();
        $this->filteredItems = [];
    }

    public function selectItem($index, $itemId)
    {
        $this->items[$index]['item_id'] = $itemId;

        // Clear search query and filtered list
        $this->searchQuery = '';
        $this->filteredItems = [];
    }


    public function searchItems()
    {
        $this->filteredItems = StoreItem::where('item_name', 'like', "%{$this->searchQuery}%")
            ->orWhere('item_code', 'like', "%{$this->searchQuery}%")
            ->get();
    }

    public function updatedSearchQuery()
    {
        if ($this->searchQuery) {
            $this->filteredItems = StoreItem::where('item_name', 'like', "%{$this->searchQuery}%")
                ->orWhere('item_code', 'like', "%{$this->searchQuery}%")
                ->get();
        } else {
            $this->filteredItems = [];
        }
    }

    public function addItem()
    {
        $this->items[] = [
            'item_id' => null,
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
        $this->total_cost = collect($this->items)->sum(fn($item) => $item['purchase_cost'] * $item['quantity'] + $item['tax']) + $this->courier_cost - $this->discount;
    }

    public function save()
    {
        $this->validate();

        // Save logic here
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
