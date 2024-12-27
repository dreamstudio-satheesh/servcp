<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body form-steps">
                    <form class="vertical-navs-step" action="">
                        <div class="row gy-5">
                            <!-- Navigation Tabs -->
                            <div class="col-lg-3">
                                <div class="nav flex-column custom-nav nav-pills" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-cust-entry-tab" data-bs-toggle="pill" data-bs-target="#v-pills-cust-entry" type="button" role="tab" aria-controls="v-pills-cust-entry" aria-selected="true">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                        </span>
                                        Cust. Entry
                                    </button>
                                    <button class="nav-link" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 2
                                        </span>
                                        General
                                    </button>
                                    <button class="nav-link" id="v-pills-initial-check-tab" data-bs-toggle="pill" data-bs-target="#v-pills-initial-check" type="button" role="tab" aria-controls="v-pills-initial-check" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 3
                                        </span>
                                        Initial Check
                                    </button>
                                    <button class="nav-link" id="v-pills-payment-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payment-info" type="button" role="tab" aria-controls="v-pills-payment-info" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 4
                                        </span>
                                        Payment Info
                                    </button>
                                    <button class="nav-link" id="v-pills-other-info-tab" data-bs-toggle="pill" data-bs-target="#v-pills-other-info" type="button" role="tab" aria-controls="v-pills-other-info" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 5
                                        </span>
                                        Other Info
                                    </button>
                                </div>
                            </div>
                            <!-- Content Area -->
                            <div class="col-lg-9">
                                <div class="tab-content">
                                    <!-- Cust. Entry Tab -->
                                    <div class="tab-pane fade show active" id="v-pills-cust-entry" role="tabpanel" aria-labelledby="v-pills-cust-entry-tab">
                                        <div>
                                            <div class="row g-4 align-items-center">
                                                <div class="col-sm">
                                                    <h5>Customer Information</h5>
                                                </div>
                                                <div class="col-sm-auto">
                                                    <div class="d-flex align-items-center">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="customerType" id="customer" value="customer" checked>
                                                            <label class="form-check-label" for="customer">Customer</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="customerType" id="dealer" value="dealer">
                                                            <label class="form-check-label" for="dealer">Dealer</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="phone">Phone*</label>
                                                    <input type="text" id="phone" class="form-control" placeholder="Search Phone" required>
                                                    <small class="text-danger">Required.</small>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="name">Name</label>
                                                    <input type="text" id="name" class="form-control" placeholder="Search Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="place">Place</label>
                                                    <input type="text" id="place" class="form-control" placeholder="Place">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" class="form-control" placeholder="Search Email">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="address">Address</label>
                                                    <input type="text" id="address" class="form-control" placeholder="Address">
                                                </div>
                                            </div>


                                        </div>
                                        <div class="mt-3">
                                            <h5>Previous Jobs</h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Job No</th>
                                                        <th>Entry Date</th>
                                                        <th>Device</th>
                                                        <th>Position</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="6" class="text-center">No data to display</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Other Tabs Placeholder -->
                                    <div class="tab-pane fade" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                                        <p>General tab content here.</p>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-initial-check" role="tabpanel" aria-labelledby="v-pills-initial-check-tab">
                                        <p>Initial Check tab content here.</p>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-payment-info" role="tabpanel" aria-labelledby="v-pills-payment-info-tab">
                                        <p>Payment Info tab content here.</p>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-other-info" role="tabpanel" aria-labelledby="v-pills-other-info-tab">
                                        <p>Other Info tab content here.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>