<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\PrintSize;

class PrintSizeManager extends Component
{
    use WithPagination;

    public $sizeId;
    public $name;
    public $height;
    public $width;
    public $remarks;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'height' => 'required|numeric|min:0',
        'width' => 'required|numeric|min:0',
        'remarks' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $printSizes = PrintSize::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.print-size-manager', compact('printSizes'));
    }

    public function resetInputFields()
    {
        $this->sizeId = null;
        $this->name = '';
        $this->height = null;
        $this->width = null;
        $this->remarks = '';
    }

    public function store()
    {
        $this->validate();

        PrintSize::updateOrCreate(['id' => $this->sizeId], [
            'name' => $this->name,
            'height' => $this->height,
            'width' => $this->width,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'Print Size ' . ($this->sizeId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $size = PrintSize::findOrFail($id);
        $this->sizeId = $size->id;
        $this->name = $size->name;
        $this->height = $size->height;
        $this->width = $size->width;
        $this->remarks = $size->remarks;
    }

    public function delete($id)
    {
        PrintSize::findOrFail($id)->delete();
        session()->flash('message', 'Print Size deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
