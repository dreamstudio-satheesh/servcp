<div>
    <div class="row">
        <!-- Device Physical Conditions List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Device Physical Conditions</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Device Physical Conditions...">
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
                            @forelse ($devicePhysicalConditions as $condition)
                            <tr>
                                <td>{{ ($devicePhysicalConditions->currentPage() - 1) * $devicePhysicalConditions->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $condition->name }}</td>
                                <td>
                                    <button wire:click="edit({{ $condition->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $condition->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Device Physical Conditions Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $devicePhysicalConditions->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Device Physical Condition Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $conditionId ? 'Edit Device Physical Condition' : 'Create Device Physical Condition' }}</h5>
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
