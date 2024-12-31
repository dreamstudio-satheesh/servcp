<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Role;
use App\Models\Branch;

class UserManagement extends Component
{
    use WithPagination, WithFileUploads;

    public $userId;
    public $name, $email, $password, $phone, $gender, $age, $blood_group;
    public $designation, $qualification, $salary_type, $salary, $opening_balance;
    public $address, $ending_date, $description, $photo, $id_card, $resume, $status;
    public $branch_id, $role_id;
    public $search = '';

    public $showForm = false;

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'phone' => 'nullable|string|max:20',
        'gender' => 'nullable|in:Male,Female',
        'age' => 'nullable|integer|min:18|max:100',
        'blood_group' => 'nullable|string|max:3',
        'designation' => 'nullable|string|max:255',
        'qualification' => 'nullable|string|max:255',
        'salary_type' => 'nullable|string|max:50',
        'salary' => 'nullable|numeric|min:0',
        'opening_balance' => 'nullable|numeric|min:0',
        'address' => 'nullable|string|max:500',
        'ending_date' => 'nullable|date',
        'description' => 'nullable|string|max:1000',
        'photo' => 'nullable|image|max:2048',
        'id_card' => 'nullable|file|max:2048',
        'resume' => 'nullable|file|max:2048',
        'status' => 'required|boolean',
        'branch_id' => 'nullable|exists:branches,id',
        'role_id' => 'required|exists:roles,id',
    ];

    public function createUser()
    {
        $this->resetInputFields();
        $this->showForm = true; 
    }

    public function hideForm()
    {   
        $this->resetInputFields();
        $this->showForm = false;
    }

    public function render()
    {
        $roles = Role::all();
        $branches = Branch::all();

        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.user-management', compact('users', 'roles', 'branches'));
    }

    public function resetInputFields()
    {
        $this->userId = null;
        $this->name = $this->email = $this->password = $this->phone = $this->gender = '';
        $this->age = $this->blood_group = $this->designation = $this->qualification = '';
        $this->salary_type = $this->salary = $this->opening_balance = '';
        $this->address = $this->ending_date = $this->description = '';
        $this->photo = $this->id_card = $this->resume = null;
        $this->status = true;
        $this->branch_id = $this->role_id = null;
       
    }

    public function store()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,
            'age' => $this->age,
            'blood_group' => $this->blood_group,
            'designation' => $this->designation,
            'qualification' => $this->qualification,
            'salary_type' => $this->salary_type,
            'salary' => $this->salary,
            'opening_balance' => $this->opening_balance,
            'address' => $this->address,
            'ending_date' => $this->ending_date,
            'description' => $this->description,
            'status' => $this->status,
            'branch_id' => $this->branch_id,
            'role_id' => $this->role_id,
        ];

        if ($this->photo) {
            $data['photo'] = $this->photo->store('photos', 'public');
        }
        if ($this->id_card) {
            $data['id_card'] = $this->id_card->store('id_cards', 'public');
        }
        if ($this->resume) {
            $data['resume'] = $this->resume->store('resumes', 'public');
        }
        if ($this->password) {
            $data['password'] = bcrypt($this->password);
        }

        User::updateOrCreate(['id' => $this->userId], $data);

        session()->flash('message', 'User ' . ($this->userId ? 'updated' : 'created') . ' successfully!');
        $this->resetInputFields();
        $this->showForm = false;
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->gender = $user->gender;
        $this->age = $user->age;
        $this->blood_group = $user->blood_group;
        $this->designation = $user->designation;
        $this->qualification = $user->qualification;
        $this->salary_type = $user->salary_type;
        $this->salary = $user->salary;
        $this->opening_balance = $user->opening_balance;
        $this->address = $user->address;
        $this->ending_date = $user->ending_date;
        $this->description = $user->description;
        $this->status = $user->status;
        $this->branch_id = $user->branch_id;
        $this->role_id = $user->role_id;

        $this->showForm = true; 
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        session()->flash('message', 'User deleted successfully!');
    }
}

