<div>
    <div class="row">

        <!-- User Form -->
        @if ($showForm)
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $userId ? 'Edit User' : 'Create User' }}</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="store">
                            <div class="row">
                                <!-- Name -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="text" class="form-control" placeholder="Name *" wire:model="name">
                                </div>
                                <!-- Email -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="email" class="form-control" placeholder="Email *" wire:model="email">
                                </div>
                                <!-- Password -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="password" class="form-control" placeholder="Password *"
                                        wire:model="password">
                                </div>
                                <!-- Phone -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="text" class="form-control" placeholder="Phone *" wire:model="phone">
                                </div>
                                <!-- Gender -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <select class="form-control" wire:model="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <!-- Age -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="number" class="form-control" placeholder="Age" wire:model="age">
                                </div>
                                <!-- Blood Group -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="text" class="form-control" placeholder="Blood Group"
                                        wire:model="blood_group">
                                </div>
                                <!-- Designation -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="text" class="form-control" placeholder="Designation"
                                        wire:model="designation">
                                </div>
                                <!-- Qualification -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="text" class="form-control" placeholder="Qualification"
                                        wire:model="qualification">
                                </div>
                                <!-- Salary Type -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="text" class="form-control" placeholder="Salary Type"
                                        wire:model="salary_type">
                                </div>
                                <!-- Salary -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="number" class="form-control" placeholder="Salary" wire:model="salary">
                                </div>
                                <!-- Opening Balance -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="number" class="form-control" placeholder="Opening Balance"
                                        wire:model="opening_balance">
                                </div>
                                <!-- Address -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <textarea class="form-control" placeholder="Address" wire:model="address"></textarea>
                                </div>
                                <!-- Ending Date -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <input type="date" class="form-control" wire:model="ending_date">
                                </div>
                                <!-- Description -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
                                </div>
                                <!-- Photo -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <label for="photo">Photo:</label>
                                    <input type="file" class="form-control" wire:model="photo">
                                </div>
                                <!-- ID Card -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <label for="id-card">Id Card:</label>
                                    <input type="file" class="form-control" wire:model="id_card">
                                </div>
                                <!-- Resume -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <label for="resume">Resure:</label>
                                    <input type="file" class="form-control" wire:model="resume">
                                </div>
                                <!-- Branch -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <select class="form-control" wire:model="branch_id">
                                        <option value="">Select Branch</option>
                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Role -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <select class="form-control" wire:model="role_id">
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Status -->
                                <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                                    <select class="form-control" wire:model="status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Buttons -->
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary me-2">Save</button>
                                <button type="button" wire:click="hideForm"
                                    class="btn btn-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else

        <!-- User List -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>User Management</h5>
                    <div class="col-xs-12 col-md-6">
                        <input wire:model.debounce.live.300ms="search" type="text" class="form-control"
                            placeholder="Search Users...">
                    </div>
                    <div class="col-sm-auto">
                        <button class="btn btn-primary ml-2" wire:click="createUser">Create User</button>
                    </div>

                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role->name ?? 'N/A' }}</td>
                                    <td>{{ $user->status ? 'Active' : 'Inactive' }}</td>
                                    <td>
                                        <button wire:click="edit({{ $user->id }})"
                                            class="btn btn-primary btn-sm">Edit</button>
                                        <button wire:click="delete({{ $user->id }})"
                                            class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>

        @endif


    </div>
</div>
