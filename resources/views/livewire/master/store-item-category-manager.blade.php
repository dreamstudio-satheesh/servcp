<div>
    <div class="row">
        <!-- Store Item Categories List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Store Item Categories</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Store Item Categories...">
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
                            @forelse ($storeItemCategories as $category)
                            <tr>
                                <td>{{ ($storeItemCategories->currentPage() - 1) * $storeItemCategories->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <button wire:click="edit({{ $category->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $category->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Store Item Categories Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $storeItemCategories->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Store Item Category Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $categoryId ? 'Edit Store Item Category' : 'Create Store Item Category' }}</h5>
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
