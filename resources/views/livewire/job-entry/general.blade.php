<div>
    <div class="card">
        <h5>Job Information {{$customerId}}</h5>
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