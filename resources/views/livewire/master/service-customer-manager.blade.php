<div>
    <div class="row">
        <!-- Service Customers List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Service Customers</h5>
                    <input wire:model.live.debounce.300ms="search" type="text" class="form-control" placeholder="Search Service Customers...">
                </div>
                <div class="card-body">
                    @if (session()->has('message'))
                    <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($serviceCustomers as $customer)
                            <tr>
                                <td>{{ ($serviceCustomers->currentPage() - 1) * $serviceCustomers->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    <button wire:click="edit({{ $customer->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $customer->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5">No Service Customers Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $serviceCustomers->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Service Customer Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $customerId ? 'Edit Service Customer' : 'Create Service Customer' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="customerType">Customer Type</label>
                            <div class="d-flex align-items-center">
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="customerType"
                                        id="customer"
                                        value="Customer"
                                        wire:model="customer_type">
                                    <label class="form-check-label" for="customer">Customer</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input
                                        class="form-check-input"
                                        type="radio"
                                        name="customerType"
                                        id="dealer"
                                        value="Dealer"
                                        wire:model="customer_type">
                                    <label class="form-check-label" for="dealer">Dealer</label>
                                </div>
                            </div>
                            @error('customer_type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Place</label>
                            <input type="text" class="form-control" wire:model="place">
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" wire:model="username">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>GST Number</label>
                            <input type="text" class="form-control" wire:model="gst_number">
                        </div>

                        <div class="form-group">
                            <label>Opening Balance</label>
                            <input type="number" class="form-control" wire:model="opening_balance">
                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" wire:model="address"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Remarks</label>
                            <textarea class="form-control" wire:model="remarks"></textarea>
                        </div>

                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button type="button" wire:click="resetInputFields" class="btn btn-secondary">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>