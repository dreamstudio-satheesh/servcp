<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-3">
        <h5>Search or Select Customer</h5>
        <input type="text" class="form-control" placeholder="Search by phone, name, or email..."
            wire:model.live.debounce.300ms="searchTerm">

        @if (count($searchResults) > 0)
            <ul class="list-group mt-2">
                @foreach ($searchResults as $result)
                    <li class="list-group-item" style="cursor: pointer;" wire:click="selectCustomer({{ $result->id }})">
                        <strong>{{ $result->name }}</strong> | {{ $result->phone }} | {{ $result->email }}
                    </li>
                @endforeach
            </ul>
        @elseif(count($searchResults) === 0 && !empty($searchTerm))
            <div class="alert alert-warning mt-2">
                No results found for “<strong>{{ $searchTerm }}</strong>”.
            </div>
        @endif
    </div>

    <form wire:submit.prevent="submitForm">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" placeholder="Name" wire:model.defer="name">
            </div>
            <div class="col-md-4 mb-3">
                <label for="phone">Phone*</label>
                <input type="text" id="phone" class="form-control" placeholder="Phone" wire:model.defer="phone"
                    required>
                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="place">Place</label>
                <input type="text" id="place" class="form-control" placeholder="Place" wire:model.defer="place">
            </div>
            <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="Email" wire:model.defer="email">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="address">Address</label>
                <input type="text" id="address" class="form-control" placeholder="Address"
                    wire:model.defer="address">
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
