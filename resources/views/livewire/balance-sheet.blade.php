<div>
    <!-- Balance Sheet Details -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-4 text-center">Balance Sheet</h5>
        </div>
        <div class="card-body">

            <!-- Date Filter -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="date" class="form-label">As of Date</label>
                    <input type="date" id="date" class="form-control" wire:model="date" wire:change="fetchBalanceSheet">
                </div>
            </div>

            <!-- Assets -->
            <h4>Assets</h4>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Account Name</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($assets as $asset)
                        <tr>
                            <td>{{ $asset->name }}</td>
                            <td>{{ number_format($asset->ledgers->sum('debit_amount') - $asset->ledgers->sum('credit_amount'), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Assets</th>
                        <th>{{ number_format($totals['assets'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Liabilities -->
            <h4>Liabilities</h4>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Account Name</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($liabilities as $liability)
                        <tr>
                            <td>{{ $liability->name }}</td>
                            <td>{{ number_format($liability->ledgers->sum('credit_amount') - $liability->ledgers->sum('debit_amount'), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Liabilities</th>
                        <th>{{ number_format($totals['liabilities'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Equity -->
            <h4>Equity</h4>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Account Name</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equity as $eq)
                        <tr>
                            <td>{{ $eq->name }}</td>
                            <td>{{ number_format($eq->ledgers->sum('credit_amount') - $eq->ledgers->sum('debit_amount'), 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total Equity</th>
                        <th>{{ number_format($totals['equity'], 2) }}</th>
                    </tr>
                </tfoot>
            </table>

            <!-- Balance Check -->
            <div class="alert {{ $totals['assets'] == $totals['liabilities'] + $totals['equity'] ? 'alert-success' : 'alert-danger' }} mt-3">
                <strong>{{ $totals['assets'] == $totals['liabilities'] + $totals['equity'] ? 'Balanced' : 'Unbalanced' }}</strong> Balance Sheet.
            </div>

        </div>
    </div>
</div>
