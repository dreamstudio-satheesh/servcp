<div>
    <div class="row">
        <!-- Complaint Estimates List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Complaint Estimates</h5>
                    <input wire:model.debounce.300ms="search" type="text" class="form-control" placeholder="Search Complaint Estimates...">
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
                                <th>Service Complaint</th>
                                <th>Estimate Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($complaintEstimates as $estimate)
                            <tr>
                                <td>{{ ($complaintEstimates->currentPage() - 1) * $complaintEstimates->perPage() + $loop->index + 1 }}</td>
                                <td>{{ $estimate->serviceComplaint->name }}</td>
                                <td>${{ number_format($estimate->estimate_amount, 2) }}</td>
                                <td>
                                    <button wire:click="edit({{ $estimate->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $estimate->id }})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No Complaint Estimates Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $complaintEstimates->links() }}
                </div>
            </div>
        </div>

        <!-- Create/Update Complaint Estimate Form -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $estimateId ? 'Edit Complaint Estimate' : 'Create Complaint Estimate' }}</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label>Service Complaint</label>
                            <select class="form-control" wire:model="service_complaint_id">
                                <option value="">Select Service Complaint</option>
                                @foreach ($serviceComplaints as $complaint)
                                    <option value="{{ $complaint->id }}">{{ $complaint->name }}</option>
                                @endforeach
                            </select>
                            @error('service_complaint_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Estimate Amount</label>
                            <input type="number" step="0.01" class="form-control" wire:model="estimate_amount">
                            @error('estimate_amount') <span class="text-danger">{{ $message }}</span> @enderror
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
