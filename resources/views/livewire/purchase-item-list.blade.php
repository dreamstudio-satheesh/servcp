<div class="card">
    <div class="card-header d-flex justify-content-between mb-3">
      <h5>Purchase Item Management</h5>
      <div>
          <input wire:model.debounce.live.300ms="search" type="text" class="form-control"
              placeholder="Search Purchase Items...">
      </div>
      <button class="btn btn-primary" wire:click="createItem">Create Purchase Item</button>
    </div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
  
    <div class="card-body">
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>No.</th>
                  <th>Purchase No</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Purchase Cost</th>
                  <th>Tax</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              @forelse ($purchaseItems as $purchaseItem)
                  <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $purchaseItem->purchase->purchase_no }}</td>
                      <td>{{ $purchaseItem->item->item_name }}</td>
                      <td>{{ $purchaseItem->quantity }}</td>
                      <td>{{ $purchaseItem->purchase_cost }}</td>
                      <td>{{ $purchaseItem->tax }}</td>
                      <td>
                          <button class="btn btn-primary btn-sm" wire:click="editItem({{ $purchaseItem->id }})">Edit</button>
                          <button class="btn btn-danger btn-sm" wire:click="deleteItem({{ $purchaseItem->id }})">Delete</button>
                      </td>
                  </tr>
              @empty
                  <tr>
                      <td colspan="7">No purchase items found</td>
                  </tr>
              @endforelse
          </tbody>
      </table>
      {{ $purchaseItems->links() }}
    </div>
  </div>
  