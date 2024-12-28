<div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body form-steps">
                    <form class="vertical-navs-step" wire:submit.prevent="save">
                        <div class="row gy-5">
                            <!-- Navigation Tabs -->
                            <div class="col-lg-3">
                                <div class="nav flex-column custom-nav nav-pills" role="tablist"
                                    aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-cust-entry-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-cust-entry" type="button" role="tab"
                                        aria-controls="v-pills-cust-entry" aria-selected="true">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 1
                                        </span>
                                        Cust. Entry
                                    </button>
                                    <button class="nav-link" id="v-pills-general-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-general" type="button" role="tab"
                                        aria-controls="v-pills-general" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 2
                                        </span>
                                        General
                                    </button>
                                    <button class="nav-link" id="v-pills-initial-check-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-initial-check" type="button" role="tab"
                                        aria-controls="v-pills-initial-check" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 3
                                        </span>
                                        Initial Check
                                    </button>
                                    <button class="nav-link" id="v-pills-payment-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-payment-info" type="button" role="tab"
                                        aria-controls="v-pills-payment-info" aria-selected="false">
                                        <span class="step-title me-2">
                                            <i class="ri-close-circle-fill step-icon me-2"></i> Step 4
                                        </span>
                                        Payment Info
                                    </button>
                                    <button class="nav-link" id="v-pills-other-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#v-pills-other-info" type="button" role="tab"
                                        aria-controls="v-pills-other-info" aria-selected="false">
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
                                    <div class="tab-pane fade show active" id="v-pills-cust-entry" role="tabpanel"
                                        aria-labelledby="v-pills-cust-entry-tab">
                                        {{-- Include the cust-entry sub-component --}}
                                        @livewire('job-entry.cust-entry')
                                    </div>

                                    <!-- General Tab -->
                                    <div class="tab-pane fade" id="v-pills-general" role="tabpanel"
                                        aria-labelledby="v-pills-general-tab">
                                        @livewire('job-entry.general')
                                    </div>

                                    <!-- Initial Check Tab -->
                                    <div class="tab-pane fade" id="v-pills-initial-check" role="tabpanel"
                                        aria-labelledby="v-pills-initial-check-tab">
                                        @livewire('job-entry.initial-check')
                                    </div>

                                    <!-- Payment Info Tab -->
                                    <div class="tab-pane fade" id="v-pills-payment-info" role="tabpanel"
                                        aria-labelledby="v-pills-payment-info-tab">
                                        @livewire('job-entry.payment-info')
                                    </div>

                                    <!-- Other Info Tab -->
                                    <div class="tab-pane fade" id="v-pills-other-info" role="tabpanel"
                                        aria-labelledby="v-pills-other-info-tab">
                                        @livewire('job-entry.other-info')
                                    </div>

                                </div> <!-- /.tab-content -->
                            </div> <!-- /.col-lg-9 -->
                        </div>
                    </form>
                </div> <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
