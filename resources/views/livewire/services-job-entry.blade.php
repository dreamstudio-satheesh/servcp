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

                                    <!-- General Tab -->
                                    <div class="tab-pane fade" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">


                                        <div class="card">
                                            <h5>Job Information</h5>
                                            <div class="card-body">
                                                
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <label for="job-number">Job Number</label>
                                                        <input type="text" id="job-number" class="form-control" value="D5N278" readonly>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="entry-date">Entry Date</label>
                                                        <input type="date" id="entry-date" class="form-control" value="2024-12-27">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="reference-number">Reference Number</label>
                                                        <input type="text" id="reference-number" class="form-control" placeholder="Number">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label>Warranty Status</label>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="warranty" id="out-warranty" value="out" checked>
                                                            <label class="form-check-label" for="out-warranty">Out Warranty</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="warranty" id="on-warranty" value="on">
                                                            <label class="form-check-label" for="on-warranty">On Warranty</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h5>Device Information</h5>
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <label for="company">Company*</label>
                                                        <input type="text" id="company" class="form-control" placeholder="Search Company" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="model">Model*</label>
                                                        <input type="text" id="model" class="form-control" placeholder="Select Model" required>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="color">Color</label>
                                                        <input type="text" id="color" class="form-control" placeholder="Search Color">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label for="imei">IMEI/Serial*</label>
                                                        <input type="text" id="imei" class="form-control" placeholder="IMEI/Serial" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="row mb-3">
                                                    <div class="col-md-3">
                                                        <label for="password">Device Password*</label>
                                                        <input type="text" id="password" class="form-control" placeholder="Device Password" required>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <label for="provider">Provider Information</label>
                                                        <input type="text" id="provider" class="form-control" placeholder="Provider Information">
                                                    </div>
                                                </div>

                                                <h5>Complaint Details</h5>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="complaint">Service Complaint*</label>
                                                        <input type="text" id="complaint" class="form-control" placeholder="Search Service Complaints" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="remarks">Other Remarks</label>
                                                        <input type="text" id="remarks" class="form-control" placeholder="Other Remarks">
                                                    </div>
                                                </div>

                                                <div class="text-end">
                                                    <button type="button" class="btn btn-success">Save</button>
                                                    <button type="button" class="btn btn-success">Save & Print</button>
                                                </div>
                                            </div>
                                        </div>

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