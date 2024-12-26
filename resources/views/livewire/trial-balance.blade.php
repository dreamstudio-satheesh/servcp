<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-4 text-center">Trial Balance</h5>
        </div>
        <div class="card-body">

            <!-- Date Filters -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" id="startDate" class="form-control" wire:model="startDate" wire:change="fetchTrialBalance">
                </div>
                <div class="col-md-6">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" id="endDate" class="form-control" wire:model="endDate" wire:change="fetchTrialBalance">
                </div>
            </div>

            <!-- Trial Balance Table -->
            <table class="table table-striped mt-4">
                <thead class="table-light">
                    <tr>
                        <th>Account Name</th>
                        <th>Account Type</th>
                        <th>Total Debit</th>
                        <th>Total Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($accounts as $account)
                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>{{ ucfirst($account->type) }}</td>
                            <td>{{ number_format($account->total_debit ?? 0, 2) }}</td>
                            <td>{{ number_format($account->total_credit ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Totals</th>
                        <th>{{ number_format($totals['debit'], 2) }}</th>
                        <th>{{ number_format($totals['credit'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Validation -->
            @if ($totals['debit'] != $totals['credit'])
                <div class="alert alert-danger">
                    <strong>Warning:</strong> The trial balance is not balanced. Please check your entries.
                </div>
            @else
                <div class="alert alert-success">
                    The trial balance is balanced.
                </div>
            @endif

        </div>
    </div>
</div>
