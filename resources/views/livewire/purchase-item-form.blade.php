<div>
    <div class="card">
        <div class="card-header">
            <h5>{{ $purchaseItemId ? 'Edit Purchase Item' : 'Create Purchase Item' }}</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-lg-4 mb-3">
                        <label>Purchase *</label>
                        <select class="form-control" wire:model="purchase_id">
                            <option value="">Select Purchase</option>
                            @foreach ($purchases as $purchase)
                                <option value="{{ $purchase->id }}">{{ $purchase->purchase_no }}</option>
                            @endforeach
                        </select>
                        @error('purchase_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Item *</label>
                        <select class="form-control" wire:model="item_id">
                            <option value="">Select Item</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                        @error('item_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Quantity *</label>
                        <input type="number" class="form-control" wire:model="quantity">
                        @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Purchase Cost *</label>
                        <input type="number" step="0.01" class="form-control" wire:model="purchase_cost">
                        @error('purchase_cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label>Tax</label>
                        <input type="number" step="0.01" class="form-control" wire:model="tax">
                        @error('tax') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary me-2">Save</button>
                    <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
