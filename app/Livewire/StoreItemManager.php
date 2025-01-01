<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\StoreItem;
use App\Models\Master\Unit;
use Livewire\WithPagination;
use App\Models\Master\StoreTax;
use App\Models\Master\StoreItemCategory;

class StoreItemManager extends Component
{
    use WithPagination;

    public $itemId, $item_code, $barcode, $category_id, $unit_id, $tax_id;
    public $item_name, $bin_and_rack, $quantity, $unit_purchase_cost, $unit_selling_price;
    public $tax_applicable = false, $disabled = false;
    public $search = '';
    public $showForm = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'item_code' => 'required|unique:store_items,item_code',
        'barcode' => 'required|unique:store_items,barcode',
        'category_id' => 'required|exists:store_item_categories,id',
        'unit_id' => 'required|exists:units,id',
        'item_name' => 'required|string|max:255',
        'unit_purchase_cost' => 'required|numeric|min:0',
        'unit_selling_price' => 'required|numeric|min:0',
        'tax_id' => 'nullable|exists:store_taxes,id',
        'quantity' => 'nullable|integer|min:0',
        'bin_and_rack' => 'nullable|string|max:255',
        'tax_applicable' => 'boolean',
        'disabled' => 'boolean',
    ];

    public function render()
    {
        $categories = StoreItemCategory::all();
        $units = Unit::all();
        $taxes = StoreTax::all();

        $items = StoreItem::with(['category', 'unit', 'tax'])
            ->where('item_name', 'like', '%' . $this->search . '%')
            ->orWhere('item_code', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.store-item-manager', compact('items', 'categories', 'units', 'taxes'));
    }

    public function createItem()
    {
        $this->resetFields();
        $this->showForm = true;
    }

    public function hideForm()
    {
        $this->resetFields();
        $this->showForm = false;
    }

    public function store()
    {
        $this->validate();

        StoreItem::updateOrCreate(
            ['id' => $this->itemId],
            [
                'item_code' => $this->item_code,
                'barcode' => $this->barcode,
                'category_id' => $this->category_id,
                'unit_id' => $this->unit_id,
                'tax_id' => $this->tax_id,
                'item_name' => $this->item_name,
                'bin_and_rack' => $this->bin_and_rack,
                'quantity' => $this->quantity,
                'unit_purchase_cost' => $this->unit_purchase_cost,
                'unit_selling_price' => $this->unit_selling_price,
                'tax_applicable' => $this->tax_applicable,
                'disabled' => $this->disabled,
            ]
        );

        session()->flash('message', 'Store Item ' . ($this->itemId ? 'updated' : 'created') . ' successfully!');
        $this->resetFields();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $item = StoreItem::findOrFail($id);

        $this->itemId = $item->id;
        $this->item_code = $item->item_code;
        $this->barcode = $item->barcode;
        $this->category_id = $item->category_id;
        $this->unit_id = $item->unit_id;
        $this->tax_id = $item->tax_id;
        $this->item_name = $item->item_name;
        $this->bin_and_rack = $item->bin_and_rack;
        $this->quantity = $item->quantity;
        $this->unit_purchase_cost = $item->unit_purchase_cost;
        $this->unit_selling_price = $item->unit_selling_price;
        $this->tax_applicable = $item->tax_applicable;
        $this->disabled = $item->disabled;

        $this->showForm = true;
    }

    public function delete($id)
    {
        StoreItem::findOrFail($id)->delete();
        session()->flash('message', 'Store Item deleted successfully!');
    }

    public function resetFields()
    {
        $this->reset([
            'itemId', 'item_code', 'barcode', 'category_id', 'unit_id', 'tax_id',
            'item_name', 'bin_and_rack', 'quantity', 'unit_purchase_cost', 'unit_selling_price',
            'tax_applicable', 'disabled',
        ]);
    }
}
