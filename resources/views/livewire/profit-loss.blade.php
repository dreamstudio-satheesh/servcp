<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-4 text-center">Profit & Loss Statement</h5>
        </div>
        <div class="card-body">

            <!-- Date Filters -->
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="date" id="startDate" class="form-control" wire:model="startDate" wire:change="fetchProfitLoss">
                </div>
                <div class="col-md-6">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="date" id="endDate" class="form-control" wire:model="endDate" wire:change="fetchProfitLoss">
                </div>
            </div>

            <!-- Revenue Section -->
            <h4>Revenue</h4>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Account Name</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($revenue as $account)
                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>{{ number_format($account->ledgers->sum('credit_amount') - $account->ledgers->sum('debit_amount'), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Revenue</th>
                        <th>{{ number_format($totals['revenue'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Expenses Section -->
            <h4>Expenses</h4>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Account Name</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expenses as $account)
                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>{{ number_format($account->ledgers->sum('debit_amount') - $account->ledgers->sum('credit_amount'), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Expenses</th>
                        <th>{{ number_format($totals['expenses'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Net Profit Section -->
            <h4>Net Profit</h4>
            <div class="alert {{ $totals['net_profit'] >= 0 ? 'alert-success' : 'alert-danger' }}">
                <strong>{{ $totals['net_profit'] >= 0 ? 'Net Profit' : 'Net Loss' }}:</strong> {{ number_format($totals['net_profit'], 2) }}
            </div>

        </div>
    </div>
</div>
