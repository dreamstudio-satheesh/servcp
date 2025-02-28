<div>
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Sales Order Form -->
    @if ($showForm)
        <div class="card">
            <div class="card-header">
                <h5>{{ $sales_order_id ? 'Edit Sales Order' : 'Create Sales Order' }}</h5>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6 mb-3 form-group">
                        <label>Order Number</label>
                        <input type="text" wire:model="order_no" class="form-control">
                        @error('order_no') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-lg-3 col-md-6 mb-3 form-group">
                        <label>Reference Number</label>
                        <input type="text" wire:model="reference_no" class="form-control">
                    </div>

                    <div class="col-lg-3 col-md-6 mb-3 form-group">
                        <label>Customer</label>
                        <select wire:model="customer_id" class="form-control">
                            <option value="">Select Customer</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                        @error('customer_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-lg-3 col-md-6 mb-3 form-group">
                        <label>Salesman</label>
                        <select wire:model="salesman_id" class="form-control">
                            <option value="">Select Salesman</option>
                            @foreach ($salesmen as $salesman)
                                <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h5>Items</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Tax</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td>
                                    <input type="text" wire:model="items.{{ $index }}.item_id" class="form-control" placeholder="Item ID">
                                </td>
                                <td>
                                    <input type="number" wire:model="items.{{ $index }}.quantity" class="form-control">
                                </td>
                                <td>
                                    <input type="number" wire:model="items.{{ $index }}.selling_price" class="form-control">
                                </td>
                                <td>
                                    <input type="number" wire:model="items.{{ $index }}.tax" class="form-control">
                                </td>
                                <td>
                                    <button wire:click="removeItem({{ $index }})" class="btn btn-sm btn-danger">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button wire:click="addItem" class="btn btn-primary">Add Item</button>

                <div class="form-group">
                    <label>Discount</label>
                    <input type="number" wire:model="discount" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tax</label>
                    <input type="number" wire:model="tax" class="form-control">
                </div>

                <h5>Total Cost: {{ $total_cost }}</h5>
                <button wire:click="save" class="btn btn-success">Save</button>
                <button wire:click="$set('showForm', false)" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Sales Order Management</h4>
                <button wire:click="create" class="btn btn-primary">Create New Sales Order</button>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Order No</th>
                            <th>Customer</th>
                            <th>Salesman</th>
                            <th>Total Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($salesOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->order_no }}</td>
                                <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                <td>{{ $order->salesman->name ?? 'N/A' }}</td>
                                <td>{{ $order->total_cost }}</td>
                                <td>
                                    <button wire:click="edit({{ $order->id }})" class="btn btn-sm btn-warning">Edit</button>
                                    <button wire:click="delete({{ $order->id }})" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $salesOrders->links() }}
            </div>
        </div>
    @endif
</div>
