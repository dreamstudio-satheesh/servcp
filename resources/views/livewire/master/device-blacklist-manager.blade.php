<div>
    <div class="row">
        <!-- Device Blacklists List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Device Blacklists</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search IMEI...">
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
                                <th>IMEI</th>
                                <th>Company</th>
                                <th>Model</th>
                                <th>Blacklisted Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deviceBlacklists as $blacklist)
                            <tr>
                                <td>{{ ($deviceBlacklists->currentPage() - 1) * $deviceBlacklists->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $blacklist->imei }}</td>
                                <td>{{ $blacklist->company->name }}</td>
                                <td>{{ $blacklist->model->name }}</td>
                                <td>{{ $blacklist->blacklisted_date }}</td>
                                <td>
                                    <button wire:click="edit({{ $blacklist->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $blacklist->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6">No Device Blacklists Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $deviceBlacklists->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Device Blacklist Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $blacklistId ? 'Edit Device Blacklist' : 'Create Device Blacklist' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Blacklisted Date</label>
                            <input type="date" class="form-control" wire:model="blacklisted_date">
                            @error('blacklisted_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>IMEI</label>
                            <input type="text" class="form-control" wire:model="imei">
                            @error('imei') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

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
                            <label>Model</label>
                            <select class="form-control" wire:model="model_id">
                                <option value="">Select Model</option>
                                @foreach ($deviceModels as $model)
                                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                                @endforeach
                            </select>
                            @error('model_id') <span class="text-danger">{{ $message }}</span> @enderror
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
