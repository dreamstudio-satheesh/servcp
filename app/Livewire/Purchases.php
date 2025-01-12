<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use Livewire\WithPagination;
use App\Models\Master\Vendor;

class Purchases extends Component
{
    use WithPagination;

    public $purchase_id, $purchase_no, $reference_no, $vendor_id, $salesman_id, $remarks;
    public $items = [];
    public $discount = 0, $courier_cost = 0, $total_cost = 0;
    public $vendors, $salesmen;
    public $showForm = false;

    protected $rules = [
        'purchase_no' => 'required|string|max:255',
        'reference_no' => 'nullable|string|max:255',
        'vendor_id' => 'required|exists:vendors,id',
        'salesman_id' => 'nullable|exists:users,id',
        'items.*.item_id' => 'required|exists:store_items,id',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.purchase_cost' => 'required|numeric|min:0',
        'items.*.tax' => 'nullable|numeric|min:0',
    ];

    public function mount()
    {
        $this->vendors = Vendor::all();
        $this->salesmen = User::all();
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $purchase = Purchase::with('items')->findOrFail($id);

        $this->purchase_id = $purchase->id;
        $this->purchase_no = $purchase->purchase_no;
        $this->reference_no = $purchase->reference_no;
        $this->vendor_id = $purchase->vendor_id;
        $this->salesman_id = $purchase->salesman_id;
        $this->remarks = $purchase->remarks;
        $this->discount = $purchase->discount;
        $this->courier_cost = $purchase->courier_cost;
        $this->items = $purchase->items->map(function ($item) {
            return [
                'id' => $item->id,
                'item_id' => $item->item_id,
                'quantity' => $item->quantity,
                'purchase_cost' => $item->purchase_cost,
                'tax' => $item->tax,
            ];
        })->toArray();

        $this->calculateTotal();
        $this->showForm = true;
    }

    public function delete($id)
    {
        Purchase::findOrFail($id)->delete();
        session()->flash('message', 'Purchase deleted successfully.');
    }

    public function save()
    {
        $this->validate();

        $purchase = Purchase::updateOrCreate(
            ['id' => $this->purchase_id],
            [
                'purchase_no' => $this->purchase_no,
                'reference_no' => $this->reference_no,
                'vendor_id' => $this->vendor_id,
                'salesman_id' => $this->salesman_id,
                'remarks' => $this->remarks,
                'discount' => $this->discount,
                'courier_cost' => $this->courier_cost,
                'total_cost' => $this->total_cost,
            ]
        );

        foreach ($this->items as $item) {
            $purchase->items()->updateOrCreate(
                ['id' => $item['id'] ?? null],
                [
                    'item_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'purchase_cost' => $item['purchase_cost'],
                    'tax' => $item['tax'],
                ]
            );
        }

        session()->flash('message', 'Purchase saved successfully!');
        $this->resetFields();
        $this->showForm = false;
    }

    public function resetFields()
    {
        $this->purchase_id = null;
        $this->purchase_no = '';
        $this->reference_no = '';
        $this->vendor_id = '';
        $this->salesman_id = '';
        $this->remarks = '';
        $this->discount = 0;
        $this->courier_cost = 0;
        $this->total_cost = 0;
        $this->items = [];
    }

    public function addItem()
    {
        $this->items[] = ['item_id' => null, 'quantity' => 1, 'purchase_cost' => 0, 'tax' => 0];
    }

    public function removeItem($index)
    {
        unset($this->items[$index]);
        $this->items = array_values($this->items);
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total_cost = collect($this->items)->sum(fn($item) => $item['quantity'] * $item['purchase_cost'] + ($item['tax'] ?? 0))
            + $this->courier_cost - $this->discount;
    }

    public function render()
    {
        $purchases = Purchase::with('vendor', 'salesman')->paginate(10);

        return view('livewire.purchases', [
            'purchases' => $purchases,
        ]);
    }
}
