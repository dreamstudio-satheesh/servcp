<div>
    <div class="row">
        <!-- Store Taxes List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Store Taxes</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Store Taxes...">
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
                                <th>Rate (%)</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($storeTaxes as $tax)
                            <tr>
                                <td>{{ ($storeTaxes->currentPage() - 1) * $storeTaxes->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $tax->name }}</td>
                                <td>{{ $tax->rate }}</td>
                                <td>{{ ucfirst($tax->type) }}</td>
                                <td>
                                    <button wire:click="edit({{ $tax->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $tax->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Store Taxes Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $storeTaxes->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Store Tax Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $taxId ? 'Edit Store Tax' : 'Create Store Tax' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Rate (%)</label>
                            <input type="number" step="0.01" class="form-control" wire:model="rate">
                            @error('rate') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Type</label>
                            <select class="form-control" wire:model="type">
                                <option value="">Select Type</option>
                                <option value="inclusive">Inclusive</option>
                                <option value="exclusive">Exclusive</option>
                            </select>
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
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
