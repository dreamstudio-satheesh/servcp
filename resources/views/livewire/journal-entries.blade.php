<div>
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-4 text-center">Journal Entries</h5>
        </div>
        <div class="card-body">

            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="alert alert-success text-center">{{ session('message') }}</div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
            @endif

            <!-- Form -->
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" id="date" class="form-control" wire:model="date">
                    @error('date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" id="description" class="form-control" wire:model="description">
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <!-- Lines -->
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Account</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lines as $index => $line)
                            <tr>
                                <td>
                                    <select wire:model="lines.{{ $index }}.account_id" class="form-select">
                                        <option value="">Select Account</option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('lines.' . $index . '.account_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <input type="number" step="0.01" wire:model="lines.{{ $index }}.debit_amount" class="form-control">
                                </td>
                                <td>
                                    <input type="number" step="0.01" wire:model="lines.{{ $index }}.credit_amount" class="form-control">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" wire:click="removeLine({{ $index }})">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" wire:click="addEmptyLine">Add Line</button>
                    <button type="submit" class="btn btn-primary">Save Journal Entry</button>
                </div>
            </form>

            <!-- Journal Entries List -->
            <h4 class="mt-4">Existing Journal Entries</h4>
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Accounts</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($journalEntries as $entry)
                        <tr>
                            <td>{{ $entry->date }}</td>
                            <td>{{ $entry->description }}</td>
                            <td>
                                <ul>
                                    @foreach ($entry->lines as $line)
                                        <li>
                                            {{ $line->account->name }}: 
                                            <strong>Debit: {{ $line->debit_amount }}</strong>, 
                                            <strong>Credit: {{ $line->credit_amount }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
