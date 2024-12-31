<div>
    <div class="row">
        <!-- Print Sizes List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Print Sizes</h5>
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search Print Sizes...">
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
                                <th>Height</th>
                                <th>Width</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($printSizes as $size)
                            <tr>
                                <td>{{ ($printSizes->currentPage() - 1) * $printSizes->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $size->name }}</td>
                                <td>{{ $size->height }}</td>
                                <td>{{ $size->width }}</td>
                                <td>{{ $size->remarks }}</td>
                                <td>
                                    <button wire:click="edit({{ $size->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $size->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Print Sizes Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $printSizes->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Print Size Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $sizeId ? 'Edit Print Size' : 'Create Print Size' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" step="0.01" class="form-control" wire:model="height">
                            @error('height') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Width</label>
                            <input type="number" step="0.01" class="form-control" wire:model="width">
                            @error('width') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" wire:model="remarks"></textarea>
                            @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
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
