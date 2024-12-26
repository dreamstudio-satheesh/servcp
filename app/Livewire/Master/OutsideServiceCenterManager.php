<?php

namespace App\Livewire\Master;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Master\OutsideServiceCenter;

class OutsideServiceCenterManager extends Component
{
    use WithPagination;

    public $centerId;
    public $name;
    public $contact_person;
    public $phone;
    public $place;
    public $email;
    public $address;
    public $other_information;
    public $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'contact_person' => 'nullable|string|max:255',
        'phone' => 'required|string|max:20',
        'place' => 'nullable|string|max:255',
        'email' => 'nullable|email|max:255',
        'address' => 'nullable|string|max:500',
        'other_information' => 'nullable|string|max:500',
    ];

    public function render()
    {
        $outsideServiceCenters = OutsideServiceCenter::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('phone', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.master.outside-service-center-manager', compact('outsideServiceCenters'));
    }

    public function resetInputFields()
    {
        $this->centerId = null;
        $this->name = '';
        $this->contact_person = '';
        $this->phone = '';
        $this->place = '';
        $this->email = '';
        $this->address = '';
        $this->other_information = '';
    }

    public function store()
    {
        $this->validate();

        OutsideServiceCenter::updateOrCreate(['id' => $this->centerId], [
            'name' => $this->name,
            'contact_person' => $this->contact_person,
            'phone' => $this->phone,
            'place' => $this->place,
            'email' => $this->email,
            'address' => $this->address,
            'other_information' => $this->other_information,
        ]);

        session()->flash('message', 'Outside Service Center ' . ($this->centerId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $center = OutsideServiceCenter::findOrFail($id);
        $this->centerId = $center->id;
        $this->name = $center->name;
        $this->contact_person = $center->contact_person;
        $this->phone = $center->phone;
        $this->place = $center->place;
        $this->email = $center->email;
        $this->address = $center->address;
        $this->other_information = $center->other_information;
    }

    public function delete($id)
    {
        OutsideServiceCenter::findOrFail($id)->delete();
        session()->flash('message', 'Outside Service Center deleted successfully!');
    }

    public function create()
    {
        $this->resetInputFields();
    }
}
