<div>
    <div class="row">
        <!-- Currencies List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Currencies</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Currencies...">
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
                                <th>Symbol</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($currencies as $currency)
                            <tr>
                                <td>{{ ($currencies->currentPage() - 1) * $currencies->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $currency->name }}</td>
                                <td>{{ $currency->symbol }}</td>
                                <td>
                                    <button wire:click="edit({{ $currency->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $currency->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Currencies Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $currencies->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Currency Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $currencyId ? 'Edit Currency' : 'Create Currency' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Symbol</label>
                            <input type="text" class="form-control" wire:model="symbol">
                            @error('symbol') <span class="text-danger">{{ $message }}</span> @enderror
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
