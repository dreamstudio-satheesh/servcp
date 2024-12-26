<div class="card shadow-sm mt-4">
    <div class="card-header">
        <h5 class="mb-4 text-center">Manage User Privileges</h5>
    </div>
    <div class="card-body">

        <!-- Role Dropdown -->
        <div class="mb-3">
            <label for="roleDropdown" class="form-label">Select Role</label>
            <select wire:model="selectedRole" id="roleDropdown" class="form-select">
                <option value="" selected disabled>Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        @if($selectedRole)
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs" id="privilegesTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab" aria-controls="general" aria-selected="true">General</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="services-tab" data-bs-toggle="tab" data-bs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false">Services</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="store-tab" data-bs-toggle="tab" data-bs-target="#store" type="button" role="tab" aria-controls="store" aria-selected="false">Store</button>
                </li>
                <!-- Add other tabs as needed -->
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-3" id="privilegesTabContent">
                <!-- General Tab -->
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                    <h5>General</h5>
                    <div>
                        @foreach($permissions->where('category', 'General') as $permission)
                            <div class="form-check">
                                <input
                                    wire:model="rolePermissions"
                                    class="form-check-input"
                                    type="checkbox"
                                    value="{{ $permission->id }}"
                                    id="permission-{{ $permission->id }}">
                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                    {{ $permission->display_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Services Tab -->
                <div class="tab-pane fade" id="services" role="tabpanel" aria-labelledby="services-tab">
                    <h5>Services</h5>
                    <div>
                        @foreach($permissions->where('category', 'Services') as $permission)
                            <div class="form-check">
                                <input
                                    wire:model="rolePermissions"
                                    class="form-check-input"
                                    type="checkbox"
                                    value="{{ $permission->id }}"
                                    id="permission-{{ $permission->id }}">
                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                    {{ $permission->display_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Add content for other tabs as needed -->
            </div>

            <!-- Update Button -->
            <div class="mt-3">
                <button wire:click="updatePrivileges" class="btn btn-success">Update</button>
            </div>

            @if (session()->has('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
        @endif
    </div>
</div>
