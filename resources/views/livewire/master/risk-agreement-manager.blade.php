<div>
    <div class="row">
        <!-- Risk Agreements List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Risk Agreements</h5>
                    <input wire:model.debounce.live.300ms="search" type="text" class="form-control" placeholder="Search Risk Agreements...">
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
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riskAgreements as $agreement)
                            <tr>
                                <td>{{ ($riskAgreements->currentPage() - 1) * $riskAgreements->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $agreement->name }}</td>
                                <td>
                                    <button wire:click="edit({{ $agreement->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $agreement->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Risk Agreements Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $riskAgreements->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Risk Agreement Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $agreementId ? 'Edit Risk Agreement' : 'Create Risk Agreement' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
