<div>
    <div class="row">
        <!-- Outside Service Centers List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Outside Service Centers</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Service Centers...">
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
                                <th>Contact Person</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($outsideServiceCenters as $center)
                            <tr>
                                <td>{{ ($outsideServiceCenters->currentPage() - 1) * $outsideServiceCenters->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $center->name }}</td>
                                <td>{{ $center->contact_person }}</td>
                                <td>{{ $center->phone }}</td>
                                <td>
                                    <button wire:click="edit({{ $center->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $center->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Outside Service Centers Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $outsideServiceCenters->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Outside Service Center Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $centerId ? 'Edit Service Center' : 'Create Service Center' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Contact Person</label>
                            <input type="text" class="form-control" wire:model="contact_person">
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Place</label>
                            <input type="text" class="form-control" wire:model="place">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" wire:model="address"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Other Information</label>
                            <textarea class="form-control" wire:model="other_information"></textarea>
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
