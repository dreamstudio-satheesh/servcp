<div>
    <div class="row">
        <!-- Roles List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Roles Manager</h5>
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search Roles...">
                </div>
                <div class="card-body">

                    @if (session()->has('message'))
                    <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Session Time (Minutes)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $role)
                            <tr>
                                <td>{{ ($roles->currentPage() - 1) * $roles->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>{{ $role->session_time_minutes }}</td>
                                <td>
                                    <button wire:click="editRole({{ $role->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="deleteRole({{ $role->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Roles Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Role Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $roleId ? 'Edit Role' : 'Create Role' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="saveRole">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" wire:model="description"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Session Time (Minutes)</label>
                            <input type="number" class="form-control" wire:model="session_time_minutes">
                            @error('session_time_minutes') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>