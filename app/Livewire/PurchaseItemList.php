<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PurchaseItem;

class PurchaseItemList extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $purchaseItems = PurchaseItem::with(['purchase', 'item'])
            ->whereHas('item', function ($query) {
                $query->where('item_name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.purchase-item-list', compact('purchaseItems'));
    }

    public function createItem()
    {
        $this->dispatch('showForm');
    }

    public function editItem($id)
    {
        $this->dispatch('showForm', $id);
    }

    public function deleteItem($id)
    {
        PurchaseItem::findOrFail($id)->delete();
        session()->flash('message', 'Purchase Item deleted successfully!');
    }
}
