<div>
    <div class="row">
        <!-- Store Dealers List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Store Dealers</h5>
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search Store Dealers...">
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
                                <th>Phone</th>
                                <th>Place</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($storeDealers as $dealer)
                            <tr>
                                <td>{{ ($storeDealers->currentPage() - 1) * $storeDealers->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $dealer->name }}</td>
                                <td>{{ $dealer->phone }}</td>
                                <td>{{ $dealer->place }}</td>
                                <td>
                                    <button wire:click="edit({{ $dealer->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $dealer->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Store Dealers Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $storeDealers->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Store Dealer Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $dealerId ? 'Edit Store Dealer' : 'Create Store Dealer' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                        </div>

                        <div class="form-group">
                            <label>Place</label>
                            <input type="text" class="form-control" wire:model="place">
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
