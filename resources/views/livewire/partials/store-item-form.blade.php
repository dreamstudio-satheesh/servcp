
<!-- Store Item Form -->

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5>{{ $itemId ? 'Edit Store Item' : 'Create Store Item' }}</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">
                <div class="row">
                    <!-- Item Code -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Item Code *</label>
                        <input type="text" class="form-control" placeholder="Item Code *" wire:model="item_code">
                        @error('item_code') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Barcode -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Barcode *</label>
                        <input type="text" class="form-control" placeholder="Barcode *" wire:model="barcode">
                        @error('barcode') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Item Name -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Item Name *</label>
                        <input type="text" class="form-control" placeholder="Item Name *" wire:model="item_name">
                        @error('item_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Category -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Category</label>
                        <select class="form-control" wire:model="category_id">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Unit -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Unit</label>
                        <select class="form-control" wire:model="unit_id">
                            <option value="">Select Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unit_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Tax -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Tax</label>
                        <select class="form-control" wire:model="tax_id">
                            <option value="">Select Tax</option>
                            @foreach ($taxes as $tax)
                                <option value="{{ $tax->id }}">{{ $tax->name }} ({{ $tax->percentage }}%)</option>
                            @endforeach
                        </select>
                        @error('tax_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Quantity -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Quantity</label>
                        <input type="number" class="form-control" placeholder="Quantity" wire:model="quantity">
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Unit Purchase Cost -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Purchase Cost</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Purchase Cost" wire:model="unit_purchase_cost">
                        @error('unit_purchase_cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Unit Selling Price -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Selling Price</label>
                        <input type="number" step="0.01" class="form-control" placeholder="Selling Price" wire:model="unit_selling_price">
                        @error('unit_selling_price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Bin and Rack -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Bin & Rack</label>
                        <input type="text" class="form-control" placeholder="Bin & Rack" wire:model="bin_and_rack">
                        @error('bin_and_rack') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Tax Applicable -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Tax Applicable</label>
                        <select class="form-control" wire:model="tax_applicable">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                        @error('tax_applicable') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <!-- Disabled -->
                    <div class="col-lg-2 col-md-3 col-sm-6 col-12 mb-2">
                        <label>Status</label>
                        <select class="form-control" wire:model="disabled">
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                        @error('disabled') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <!-- Buttons -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <button type="button" wire:click="hideForm" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
