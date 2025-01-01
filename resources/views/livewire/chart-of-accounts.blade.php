<div>
   
    <!-- Form -->
    <div class="card shadow-sm">
        <div class="card-header">
           <h5 class="mb-4 text-center">Chart of Accounts</h5>
          <!-- Flash Messages -->
          @if (session()->has('message'))
          <div class="alert alert-success text-center">{{ session('message') }}</div>
          @endif
          </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Account Name</label>
                        <input type="text" id="name" class="form-control" wire:model="name" />
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="code" class="form-label">Account Code</label>
                        <input type="text" id="code" class="form-control" wire:model="code" />
                        @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="type" class="form-label">Account Type</label>
                        <select id="type" class="form-select" wire:model="type">
                            <option value="">Select Type</option>
                            @foreach ($types as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="parent_id" class="form-label">Parent Account</label>
                        <select id="parent_id" class="form-select" wire:model="parent_id">
                            <option value="">None</option>
                            @foreach ($accounts as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">{{ $isEdit ? 'Update' : 'Add' }}</button>
                    <button type="button" class="btn btn-secondary" wire:click="resetInput">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Accounts List -->
    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Parent</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accounts as $account)
                        <tr>
                            <td style="font-weight: bold;">{{ $account->code }}</td>
                            <td style="font-weight: bold;">{{ $account->name }}</td>
                            <td>{{ $account->type }}</td>
                            <td>{{ $account->parent ? $account->parent->name : 'None' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $account->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $account->id }})">Delete</button>
                            </td>
                        </tr>
                        @foreach ($account->children as $child)
                        <tr>
                            <td class="ps-4">{{ $child->code }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ $child->type }}</td>
                            <td>{{ $child->parent ? $child->parent->name : 'None' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" wire:click="edit({{ $child->id }})">Edit</button>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $child->id }})">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
