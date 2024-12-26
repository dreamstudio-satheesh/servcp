
<div>
    <div class="row">
        <!-- Device Colors List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Device Colors</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Device Colors...">
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
                            @forelse ($deviceColors as $color)
                            <tr>
                                <td>{{ ($deviceColors->currentPage() - 1) * $deviceColors->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $color->name }}</td>
                                <td>
                                    <button wire:click="edit({{ $color->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $color->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Device Colors Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $deviceColors->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Device Color Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $colorId ? 'Edit Device Color' : 'Create Device Color' }}</h5>
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
