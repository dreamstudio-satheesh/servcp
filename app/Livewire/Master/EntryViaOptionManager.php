<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\EntryViaOption;

class EntryViaOptionManager extends Component
{
    use WithPagination;

    public $optionId;
    public $name;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function render()
    {
        $entryViaOptions = EntryViaOption::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.entry-via-option-manager', compact('entryViaOptions'));
    }

    public function resetInputFields()
    {
        $this->optionId = null;
        $this->name = '';
    }

    public function store()
    {
        $this->validate();

        EntryViaOption::updateOrCreate(['id' => $this->optionId], [
            'name' => $this->name,
        ]);

        session()->flash('message', 'Entry Via Option ' . ($this->optionId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $option = EntryViaOption::findOrFail($id);
        $this->optionId = $option->id;
        $this->name = $option->name;
    }

    public function delete($id)
    {
        EntryViaOption::findOrFail($id)->delete();
        session()->flash('message', 'Entry Via Option deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
