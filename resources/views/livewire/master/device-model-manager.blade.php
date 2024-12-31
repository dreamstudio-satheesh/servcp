<div>
    <div class="row">
        <!-- Device Models List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Device Models</h5>
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search Device Models...">
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
                                <th>Company</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deviceModels as $model)
                            <tr>
                                <td>{{ ($deviceModels->currentPage() - 1) * $deviceModels->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $model->name }}</td>
                                <td>{{ $model->company->name }}</td>
                                <td>
                                    <button wire:click="edit({{ $model->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $model->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Device Models Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $deviceModels->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Device Model Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $modelId ? 'Edit Device Model' : 'Create Device Model' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" wire:model="company_id">
                                <option value="">Select Company</option>
                                @foreach ($deviceCompanies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                            @error('company_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

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
