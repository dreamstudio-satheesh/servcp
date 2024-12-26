<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-4 text-center">Ledger Management</h5>
        </div>
        <div class="card-body">

            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif

            <!-- Filters -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="accountFilter" class="form-label">Filter by Account</label>
                    <select id="accountFilter" class="form-select" wire:model="account_id" wire:change="fetchLedgers">
                        <option value="">All Accounts</option>
                        @foreach ($accounts as $account)
                            <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" id="startDate" class="form-control" wire:model="startDate" wire:change="fetchLedgers" />
                </div>
                <div class="col-md-4">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" id="endDate" class="form-control" wire:model="endDate" wire:change="fetchLedgers" />
                </div>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="store">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="account" class="form-label">Account</label>
                        <select id="account" class="form-select" wire:model="account_id">
                            <option value="">Select Account</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                            @endforeach
                        </select>
                        @error('account_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" id="date" class="form-control" wire:model="date" />
                        @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" class="form-control" wire:model="description" />
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="debit_amount" class="form-label">Debit</label>
                        <input type="number" id="debit_amount" class="form-control" wire:model="debit_amount" step="0.01" />
                        @error('debit_amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="credit_amount" class="form-label">Credit</label>
                        <input type="number" id="credit_amount" class="form-control" wire:model="credit_amount" step="0.01" />
                        @error('credit_amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Add Entry</button>
                    <button type="button" class="btn btn-secondary" wire:click="resetInput">Reset</button>
                </div>
            </form>

            <!-- Ledger List -->
            <table class="table mt-4 table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Account</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ledgers as $ledger)
                        <tr>
                            <td>{{ $ledger->date }}</td>
                            <td>{{ $ledger->account->code }} - {{ $ledger->account->name }}</td>
                            <td>{{ $ledger->description }}</td>
                            <td>{{ number_format($ledger->debit_amount, 2) }}</td>
                            <td>{{ number_format($ledger->credit_amount, 2) }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $ledger->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No transactions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
