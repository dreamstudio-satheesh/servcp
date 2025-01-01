 <!-- Store Item List -->

 <div class="col-md-12">
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h5>Store Item Management</h5>
            <div class="col-xs-12 col-md-6">
                <input wire:model.debounce.live.300ms="search" type="text" class="form-control"
                    placeholder="Search Store Items...">
            </div>
            <div class="col-sm-auto">
                <button class="btn btn-primary ml-2" wire:click="createItem">Create Store Item</button>
            </div>

        </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Item Code</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Purchase Cost</th>
                        <th>Selling Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->item_code }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->category->name ?? 'N/A' }}</td>
                            <td>{{ $item->unit->name ?? 'N/A' }}</td>
                            <td>{{ $item->unit_purchase_cost }}</td>
                            <td>{{ $item->unit_selling_price }}</td>
                            <td>{{ $item->disabled ? 'Inactive' : 'Active' }}</td>
                            <td>
                                <button wire:click="edit({{ $item->id }})"
                                    class="btn btn-primary btn-sm">Edit</button>
                                <button wire:click="delete({{ $item->id }})"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No store items found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
</div>