<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\PurchaseItem;
use App\Models\Purchase;
use App\Models\StoreItem;

class PurchaseItemForm extends Component
{
    public $purchaseItemId, $purchase_id, $item_id, $quantity, $purchase_cost, $tax;

    protected $rules = [
        'purchase_id' => 'required|exists:purchases,id',
        'item_id' => 'required|exists:store_items,id',
        'quantity' => 'required|integer|min:1',
        'purchase_cost' => 'required|numeric|min:0',
        'tax' => 'nullable|numeric|min:0',
    ];

    public function mount($purchaseItemId = null)
    {
        if ($purchaseItemId) {
            $item = PurchaseItem::findOrFail($purchaseItemId);
            $this->purchaseItemId = $item->id;
            $this->purchase_id = $item->purchase_id;
            $this->item_id = $item->item_id;
            $this->quantity = $item->quantity;
            $this->purchase_cost = $item->purchase_cost;
            $this->tax = $item->tax;
        }
    }

    public function render()
    {
        $purchases = Purchase::all();
        $items = StoreItem::all();

        return view('livewire.purchase-item-form', compact('purchases', 'items'));
    }

    public function save()
    {
        $this->validate();

        PurchaseItem::updateOrCreate(
            ['id' => $this->purchaseItemId],
            [
                'purchase_id' => $this->purchase_id,
                'item_id' => $this->item_id,
                'quantity' => $this->quantity,
                'purchase_cost' => $this->purchase_cost,
                'tax' => $this->tax,
            ]
        );

        session()->flash('message', 'Purchase Item ' . ($this->purchaseItemId ? 'updated' : 'created') . ' successfully!');
        $this->dispatch('hideForm');
    }

    public function cancel()
    {
        $this->dispatch('hideForm');
    }
}
