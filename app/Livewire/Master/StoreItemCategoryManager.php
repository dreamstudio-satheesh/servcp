<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\StoreItemCategory;

class StoreItemCategoryManager extends Component
{
    use WithPagination;

    public $categoryId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $storeItemCategories = StoreItemCategory::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.store-item-category-manager', compact('storeItemCategories'));
    }

    public function resetInputFields()
    {
        $this->categoryId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        StoreItemCategory::updateOrCreate(['id' => $this->categoryId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Store Item Category ' . ($this->categoryId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = StoreItemCategory::findOrFail($id);
        $this->categoryId = $category->id;
        $this->name = $category->name;
    }

    public function delete($id)
    {
        StoreItemCategory::findOrFail($id)->delete();
        session()->flash('message', 'Store Item Category deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
