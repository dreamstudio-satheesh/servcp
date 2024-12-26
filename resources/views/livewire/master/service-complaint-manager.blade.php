<div>
    <div class="row">
        <!-- Service Complaints List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Service Complaints</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Service Complaints...">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($serviceComplaints as $complaint)
                            <tr>
                                <td>{{ ($serviceComplaints->currentPage() - 1) * $serviceComplaints->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $complaint->name }}</td>
                                <td>
                                    <button wire:click="edit({{ $complaint->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $complaint->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Service Complaints Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $serviceComplaints->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Service Complaint Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $complaintId ? 'Edit Service Complaint' : 'Create Service Complaint' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
