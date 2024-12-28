<div>
    <!-- Flash message example -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-3">
        <h5>Search or Select Customer</h5>
        <input type="text" class="form-control" placeholder="Search by phone, name, or email..."
            wire:model.live.debounce.100ms="searchTerm">


        <!-- Search Results Dropdown -->
        @if (count($searchResults) > 0)
            <ul class="list-group mt-2">
                @foreach ($searchResults as $result)
                    <li class="list-group-item" style="cursor: pointer;" wire:click="selectCustomer({{ $result->id }})">
                        <strong>{{ $result->name }}</strong>
                        | {{ $result->phone }}
                        | {{ $result->email }}
                    </li>
                @endforeach
            </ul>
        @elseif(count($searchResults) === 0 && !empty($searchTerm))
            <div class="alert alert-warning mt-2">
                No results found for “<strong>{{ $searchTerm }}</strong>”.
            </div>
        @endif

    </div>

    <hr>

    <div class="row g-4 align-items-center mb-3">
        <div class="col-sm">
            <h5>Customer Information</h5>
        </div>
        <div class="col-sm-auto">
            <div class="d-flex align-items-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="customer_type" id="customer" value="Customer"
                        wire:model="customer_type">
                    <label class="form-check-label" for="customer">
                        Customer
                    </label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="customer_type" id="dealer" value="Dealer"
                        wire:model="customer_type">
                    <label class="form-check-label" for="dealer">
                        Dealer
                    </label>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form wire:submit.prevent="submitForm">
        <div class="row">

            <!-- Name -->
            <div class="col-md-4 mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" placeholder="Name" wire:model.defer="name">
            </div>

            <!-- Phone -->
            <div class="col-md-4 mb-3">
                <label for="phone">Phone*</label>
                <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror"
                    placeholder="Phone" wire:model.defer="phone" required>
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Place -->
            <div class="col-md-4 mb-3">
                <label for="place">Place</label>
                <input type="text" id="place" class="form-control" placeholder="Place" wire:model.defer="place">
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    placeholder="Email" wire:model.defer="email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Address -->
            <div class="col-md-6 mb-3">
                <label for="address">Address</label>
                <input type="text" id="address" class="form-control" placeholder="Address"
                    wire:model.defer="address">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
        </div>
    </form>

    <!-- Previous Jobs -->
    <div class="mt-4">
        <h5>Previous Jobs</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Job No</th>
                    <th>Entry Date</th>
                    <th>Device</th>
                    <th>Position</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($previousJobs as $index => $job)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $job->job_no }}</td>
                        <td>{{ $job->entry_date }}</td>
                        <td>{{ $job->device }}</td>
                        <td>{{ $job->position }}</td>
                        <td>
                            <!-- e.g., a link or button to open/edit that job -->
                            <button class="btn btn-sm btn-info">
                                View
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            No data to display
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>




</div>
