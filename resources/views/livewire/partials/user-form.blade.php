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
                        <label>Name *</label>
                        <input type="text" class="form-control" placeholder="Name *" wire:model="name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Email -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Email *</label>
                        <input type="email" class="form-control" placeholder="Email *" wire:model="email">
                        @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Password -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Password *</label>
                        <input type="password" class="form-control" placeholder="Password *" wire:model="password">
                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Phone -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Phone</label>
                        <input type="text" class="form-control" placeholder="Phone *" wire:model="phone">
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Gender -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Gender</label>
                        <select class="form-control" wire:model="gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Age -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Age</label>
                        <input type="number" class="form-control" placeholder="Age" wire:model="age">
                        @error('age') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Blood Group -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Blood Group</label>
                        <input type="text" class="form-control" placeholder="Blood Group" wire:model="blood_group">
                        @error('blood_group') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Designation -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Designation</label>
                        <input type="text" class="form-control" placeholder="Designation" wire:model="designation">
                        @error('designation') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Qualification -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Qualification</label>
                        <input type="text" class="form-control" placeholder="Qualification" wire:model="qualification">
                        @error('qualification') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Salary Type -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Salary Type</label>
                        <input type="text" class="form-control" placeholder="Salary Type" wire:model="salary_type">
                        @error('salary_type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Salary -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Salary</label>
                        <input type="number" class="form-control" placeholder="Salary" wire:model="salary">
                        @error('salary') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Opening Balance -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Opening Balance</label>
                        <input type="number" class="form-control" placeholder="Opening Balance" wire:model="opening_balance">
                        @error('opening_balance') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Address -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Address</label>
                        <textarea class="form-control" placeholder="Address" wire:model="address"></textarea>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Ending Date -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Ending Date</label>
                        <input type="date" class="form-control" wire:model="ending_date">
                        @error('ending_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Description -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Description</label>
                        <textarea class="form-control" placeholder="Description" wire:model="description"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Photo -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label for="photo">Photo:</label>
                        <input type="file" class="form-control" wire:model="photo">
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- ID Card -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label for="id-card">Id Card:</label>
                        <input type="file" class="form-control" wire:model="id_card">
                        @error('id_card') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Resume -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label for="resume">Resume:</label>
                        <input type="file" class="form-control" wire:model="resume">
                        @error('resume') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Branch -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Branch</label>
                        <select class="form-control" wire:model="branch_id">
                            <option value="">Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Role -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Role</label>
                        <select class="form-control" wire:model="role_id">
                            <option value="">Select Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Status -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Status</label>
                        <select class="form-control" wire:model="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!-- Buttons -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <button type="button" wire:click="hideForm" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
