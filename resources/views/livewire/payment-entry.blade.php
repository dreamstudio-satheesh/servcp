<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-4 text-center">Payment Entry</h5>
        </div>
        <div class="card-body">

            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @endif

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
                        <label for="reference" class="form-label">Reference</label>
                        <input type="text" id="reference" class="form-control" wire:model="reference" />
                        @error('reference') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" class="form-control" wire:model="description" />
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="amount" class="form-label">Amount</label>
                        <input type="number" id="amount" class="form-control" wire:model="amount" step="0.01" />
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                    <button type="button" class="btn btn-secondary" wire:click="resetInput">Reset</button>
                </div>
            </form>

            <!-- Payments List -->
            <table class="table mt-4 table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Account</th>
                        <th>Reference</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Entry Staff</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($payments as $payment)
                        <tr>
                            <td>{{ $payment->date }}</td>
                            <td>{{ $payment->account->code }} - {{ $payment->account->name }}</td>
                            <td>{{ $payment->reference }}</td>
                            <td>{{ $payment->description }}</td>
                            <td>{{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->staff->name }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" wire:click="delete({{ $payment->id }})">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No payments found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
