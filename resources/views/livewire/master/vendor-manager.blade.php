<div>
    <div class="row">
        <!-- Vendors List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Vendors</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Vendors...">
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
                            @forelse ($vendors as $vendor)
                            <tr>
                                <td>{{ ($vendors->currentPage() - 1) * $vendors->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $vendor->name }}</td>
                                <td>{{ $vendor->contact_person }}</td>
                                <td>{{ $vendor->phone }}</td>
                                <td>
                                    <button wire:click="edit({{ $vendor->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $vendor->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Vendors Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Vendor Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $vendorId ? 'Edit Vendor' : 'Create Vendor' }}</h5>
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
                            <label>GST Number</label>
                            <input type="text" class="form-control" wire:model="gst_number">
                        </div>

                        <div class="form-group">
                            <label>Opening Balance</label>
                            <input type="number" class="form-control" wire:model="opening_balance">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" wire:model="address"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" wire:model="remarks"></textarea>
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
