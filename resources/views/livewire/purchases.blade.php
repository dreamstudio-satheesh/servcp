<div>
    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Purchase Form -->
    @if ($showForm)
        <div class="card">
            <div class="card-header">
                <h5>{{ $purchase_id ? 'Edit Purchase' : 'Create Purchase' }}</h5>
            </div>

            <div class="card-body">
               <div class="row">
                <div class="col-lg-3 col-md-6 mb-3 form-group">
                    <label>Purchase Number</label>
                    <input type="text" wire:model="purchase_no" class="form-control">
                    @error('purchase_no')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-lg-3 col-md-6 mb-3 form-group">
                    <label>Reference Number</label>
                    <input type="text" wire:model="reference_no" class="form-control">
                </div>

                <div class="col-lg-3 col-md-6 mb-3 form-group">
                    <label>Vendor</label>
                    <select wire:model="vendor_id" class="form-control">
                        <option value="">Select Vendor</option>
                        @foreach ($vendors as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                        @endforeach
                    </select>
                    @error('vendor_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
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
                            <th>Cost</th>
                            <th>Tax</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $index => $item)
                            <tr>
                                <td>
                                    <input type="text" wire:model="items.{{ $index }}.item_id"
                                        class="form-control" placeholder="Item ID">
                                </td>
                                <td>
                                    <input type="number" wire:model="items.{{ $index }}.quantity"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="number" wire:model="items.{{ $index }}.purchase_cost"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="number" wire:model="items.{{ $index }}.tax"
                                        class="form-control">
                                </td>
                                <td>
                                    <button wire:click="removeItem({{ $index }})"
                                        class="btn btn-sm btn-danger">Remove</button>
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
                    <label>Courier Cost</label>
                    <input type="number" wire:model="courier_cost" class="form-control">
                </div>

                <h5>Total Cost: {{ $total_cost }}</h5>
                <button wire:click="save" class="btn btn-success">Save</button>
                <button wire:click="$set('showForm', false)" class="btn btn-secondary">Cancel</button>
            </div>
        </div>
    @else
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Purchase Management</h4>
                <button wire:click="create" class="btn btn-primary">Create New Purchase</button>
            </div>
            <!-- List of Purchases -->
            <div class="card-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Purchase No</th>
                            <th>Vendor</th>
                            <th>Salesman</th>
                            <th>Total Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->id }}</td>
                                <td>{{ $purchase->purchase_no }}</td>
                                <td>{{ $purchase->vendor->name ?? 'N/A' }}</td>
                                <td>{{ $purchase->salesman->name ?? 'N/A' }}</td>
                                <td>{{ $purchase->total_cost }}</td>
                                <td>
                                    <button wire:click="edit({{ $purchase->id }})"
                                        class="btn btn-sm btn-warning">Edit</button>
                                    <button wire:click="delete({{ $purchase->id }})"
                                        class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $purchases->links() }}
            </div>
        </div>
    @endif
</div>
