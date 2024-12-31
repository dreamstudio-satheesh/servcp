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