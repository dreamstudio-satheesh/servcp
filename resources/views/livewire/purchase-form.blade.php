<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Create Purchase</h5>
            <button wire:click="resetForm" class="btn btn-secondary">Reset</button>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <!-- Purchase No -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label>Purchase No</label>
                        <input type="text" class="form-control" wire:model="purchase_no">
                        @error('purchase_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Reference No -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label>Reference No</label>
                        <input type="text" class="form-control" placeholder="Reference No" wire:model="reference_no">
                        @error('reference_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Vendor -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label>Vendor</label>
                        <select class="form-control" wire:model="vendor_id">
                            <option value="">Select Vendor</option>
                            @foreach ($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>
                        @error('vendor_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Salesman -->
                    <div class="col-lg-3 col-md-6 mb-3">
                        <label>Salesman</label>
                        <select class="form-control" wire:model="salesman_id">
                            <option value="">Select Salesman</option>
                            @foreach ($salesmen as $salesman)
                                <option value="{{ $salesman->id }}">{{ $salesman->name }}</option>
                            @endforeach
                        </select>
                        @error('salesman_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remarks -->
                    <div class="col-12 mb-3">
                        <label>Remarks</label>
                        <textarea class="form-control" placeholder="Remarks" wire:model="remarks"></textarea>
                        @error('remarks')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Items -->
                <!-- Items -->
                <div class="mt-4">
                    <h6>Items</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Search Item</th>
                                <th>Item Name</th>
                                <th>Purchase Cost</th>
                                <th>Quantity</th>
                                <th>Tax</th>
                                <th>Total</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $index => $item)
                                <tr>
                                    <td>
                                        <input 
                                            type="text" 
                                            class="form-control" 
                                            wire:model="searchQuery"
                                            placeholder="Search by code or name"
                                            wire:keyup="searchItems">
                                        <ul class="list-group mt-2" style="position: absolute; z-index: 999; max-height: 150px; overflow-y: auto;">
                                            @foreach ($filteredItems as $storeItem)
                                                <li 
                                                    class="list-group-item"
                                                    wire:click="selectItem({{ $index }}, {{ $storeItem->id }})"
                                                    style="cursor: pointer;">
                                                    {{ $storeItem->item_name }} ({{ $storeItem->item_code }})
                                                </li>
                                            @endforeach
                                        </ul>
                                        @error('items.' . $index . '.item_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    
                                    <td>
                                        {{ optional(\App\Models\StoreItem::find($item['item_id']))->item_name ?? '' }}
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            wire:model="items.{{ $index }}.purchase_cost">
                                        @error('items.' . $index . '.purchase_cost')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            wire:model="items.{{ $index }}.quantity">
                                        @error('items.' . $index . '.quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        <input type="number" class="form-control"
                                            wire:model="items.{{ $index }}.tax">
                                        @error('items.' . $index . '.tax')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td>
                                        {{ $item['purchase_cost'] * $item['quantity'] + $item['tax'] }}
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="removeItem({{ $index }})">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button class="btn btn-primary" wire:click.prevent="addItem">Add Item</button>
                </div>

                <!-- Summary -->
                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <label>Discount</label>
                        <input type="number" step="0.01" class="form-control" wire:model="discount">
                        @error('discount')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label>Courier Cost</label>
                        <input type="number" step="0.01" class="form-control" wire:model="courier_cost">
                        @error('courier_cost')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-lg-4 col-md-6 mb-3">
                        <label>Total Cost</label>
                        <input type="text" class="form-control" value="{{ $total_cost }}" readonly>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Save</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary ms-3">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
