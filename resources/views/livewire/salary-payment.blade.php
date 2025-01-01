<div>
    <!-- Create New Payment Button -->
    <div class="d-flex justify-content-between mb-3">
        <h5>Salary Payments</h5>
        <button class="btn btn-primary" wire:click="createPayment">New Payment</button>
    </div>

    <!-- Payment Form -->
    @if ($showForm)
        <div class="card mb-3">
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Date</label>
                            <input type="date" class="form-control" wire:model="date">
                            @error('date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Staff</label>
                            <select class="form-control" wire:model="staff_id">
                                <option value="">Select Staff</option>
                                @foreach ($staff as $person)
                                    <option value="{{ $person->id }}">{{ $person->name }}</option>
                                @endforeach
                            </select>
                            @error('staff_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Amount</label>
                            <input type="number" class="form-control" wire:model="amount" placeholder="Enter amount">
                            @error('amount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Description</label>
                            <textarea class="form-control" wire:model="description" placeholder="Description"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Payment Type</label>
                            <select class="form-control" wire:model="payment_type">
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Digital">Digital</option>
                            </select>
                            @error('payment_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @if ($payment_type === 'Cheque')
                            <div class="col-md-4 mb-3">
                                <label>Cheque No.</label>
                                <input type="text" class="form-control" wire:model="cheque_no">
                                @error('cheque_no')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Due Date</label>
                                <input type="date" class="form-control" wire:model="due_date">
                                @error('due_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        @if ($payment_type === 'Digital')
                            <div class="col-md-4 mb-3">
                                <label>Account</label>
                                <select class="form-control" wire:model="account_id">
                                    <option value="">Select Account</option>
                                    <!-- Populate accounts here -->
                                </select>
                                @error('account_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Remarks</label>
                                <textarea class="form-control" wire:model="remarks"></textarea>
                                @error('remarks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <button class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary"
                        wire:click="$set('showForm', false)">Cancel</button>
                </form>
            </div>
        </div>
    @endif

    <!-- Payment List -->
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Staff</th>
                        <th>Amount</th>
                        <th>Payment Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments as $payment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $payment->date }}</td>
                            <td>{{ $payment->staff->name }}</td>
                            <td>{{ $payment->amount }}</td>
                            <td>{{ $payment->payment_type }}</td>
                            <td>
                                <!-- Actions like edit/delete -->
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No payments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $payments->links() }}

        </div>
    </div>

</div>
