<div>
    <div class="row">
        <!-- Device Accessories List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Device Accessories</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Device Accessories...">
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
                                <th>With Serial No</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deviceAccessories as $accessory)
                            <tr>
                                <td>{{ ($deviceAccessories->currentPage() - 1) * $deviceAccessories->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $accessory->name }}</td>
                                <td>{{ $accessory->with_serial_no ? 'Yes' : 'No' }}</td>
                                <td>
                                    <button wire:click="edit({{ $accessory->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $accessory->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Device Accessories Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $deviceAccessories->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Device Accessory Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $accessoryId ? 'Edit Device Accessory' : 'Create Device Accessory' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>With Serial No</label>
                            <input type="checkbox" wire:model="with_serial_no">
                            @error('with_serial_no') <span class="text-danger">{{ $message }}</span> @enderror
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
