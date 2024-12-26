        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="{{ url('home') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ assets('') }}/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ assets('') }}/assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="{{ url('home') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ assets('') }}/assets/images/logo-sm.png" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ assets('') }}/assets/images/logo-light.png" alt="" height="17">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                        <li class="nav-item">
                            <a href="{{ url('home') }}" class="nav-link" data-key="t-home">
                                <i class="mdi mdi-home"></i> <span>Home</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarServices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarServices">
                                <i class="mdi mdi-wrench"></i> <span data-key="t-services">Services</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarServices">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-job-entry">Job Entry</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-assign-tech">Assign Technician</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-take-job">Take For Job</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-close-job">Close Job</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-item-delivery">Item Delivery</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-spot-delivery">Spot Delivery</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-outside-service">Outside Service</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-return-service">Return From Outside Service</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-call-response">Call To Customer And Response</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-refund">Refund</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-service-loss">Service Loss</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-change-position">Change Position of Service</a></li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarReprint" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReprint">
                                            <i class="mdi mdi-printer"></i> <span data-key="t-reprint">Reprint</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarReprint">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-job-entry-single">Job Entry Single</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-delivery-single">Delivery Single</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-job-entry-multiple">Job Entry Multiple</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-delivery-multiple">Delivery Multiple</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-feedback">Feedback</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-communications">Communications</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-barcode-printing">Job Barcode Printing</a></li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarStore" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarStore">
                                <i class="mdi mdi-store"></i> <span data-key="t-store">Store</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarStore">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-item-register">Item Register</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-purchase">Purchase</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-sale">Sale</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-purchase-order">Purchase Order</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-sales-order">Sales Order</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-purchase-return">Purchase Return</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-sale-return">Sale Return</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-stock-adjustment">Stock Adjustment</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-opening-stock">Opening Stock</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-requested-items">Requested Items</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-barcode-printing">Store Barcode Printing</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Accounts -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarAccounts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAccounts">
                                <i class="mdi mdi-finance"></i> <span data-key="t-accounts">Accounts</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarAccounts">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="{{ route('chart-of-accounts') }}" class="nav-link" data-key="t-chart-of-accounts">Chart of Accounts</a></li>
                                    <li class="nav-item"><a href="{{ route('ledgers') }}" class="nav-link" data-key="t-ledger">Ledger</a></li>
                                    <li class="nav-item"><a href="{{ route('receipt-entry') }}" class="nav-link" data-key="t-receipt-entry">Receipt Entry</a></li>
                                    <li class="nav-item"><a href="{{ route('payment-entry') }}" class="nav-link" data-key="t-payment-entry">Payment Entry</a></li>
                                    <li class="nav-item"><a href="{{ route('journal-entries') }}" class="nav-link" data-key="t-journal-entry">Journal Entry</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-journal-report">Journal Report</a></li>
                                    <li class="nav-item"><a href="{{ route('balance-sheet') }}" class="nav-link" data-key="t-balance-sheet">Balance Sheet</a></li>
                                    <li class="nav-item"><a href="{{ route('profit-loss') }}" class="nav-link" data-key="t-profit-loss">Profit and Loss</a></li>
                                    <li class="nav-item"><a href="{{ route('trial-balance') }}" class="nav-link" data-key="t-trial-balance">Trial Balance</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- HR Management -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarHR" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarHR">
                                <i class="mdi mdi-account-group-outline"></i> <span data-key="t-hr-management">HR Management</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarHR">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-user-management">User Management</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-attendance-register">Attendance Register</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-salary-payment">Salary Payment</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-staff-review">Staff Review</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-attendance-report">Attendance Report</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-salary-report">Salary Report</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Reports -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarReports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarReports">
                                <i class="mdi mdi-chart-box-outline"></i> <span data-key="t-reports">Reports</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarReports">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-mis-report">MIS Report</a></li>
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarServiceReports" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarServiceReports">
                                            <i class="mdi mdi-file-chart"></i> <span data-key="t-service-reports">Service Reports</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarServiceReports">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-job-entry-report">Job Entry Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-due-date-service">Due Date Based Service Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-pending-item">Pending Item Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-delivered-item">Delivered Item Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-job-delivery-report">Job Entry & Delivered Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-spare-parts">Spare Parts Waiting Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-compliant-report">Compliant Wise Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-entry-staff">Entry Staff Comparison Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-warranty-report">Warranty Based Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-technician-report">Technician Wise Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-service-dealer">Service Dealer Wise Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-outside-center">Outside Service Center Reports</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-account-related">Account Related Reports</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-stock-report">Stock Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-store-items">Store Items Report</a></li>
                                                <li class="nav-item"><a href="#" class="nav-link" data-key="t-customer-details">Customer Details Report</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <!-- Settings -->
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarSettings" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSettings">
                                <i class="mdi mdi-cog-outline"></i> <span data-key="t-settings">Settings</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarSettings">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link menu-link" href="#sidebarMaster" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarMaster">
                                            <i class="mdi mdi-database"></i> <span data-key="t-master">Master</span>
                                        </a>
                                        <div class="collapse menu-dropdown" id="sidebarMaster">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item"><a href="{{ route('roles') }}" class="nav-link" data-key="t-roles">Roles</a></li>
                                                <li class="nav-item"><a href="{{ route('device-companies') }}" class="nav-link" data-key="t-device-companies">Device Companies</a></li>
                                                <li class="nav-item"><a href="{{ route('device-colors') }}" class="nav-link" data-key="t-device-colors">Device Colors</a></li>
                                                <li class="nav-item"><a href="{{ route('device-physical-conditions') }}" class="nav-link" data-key="t-device-conditions">Device Physical Conditions</a></li>
                                                <li class="nav-item"><a href="{{ route('device-accessories') }}" class="nav-link" data-key="t-accessories">Device Accessories</a></li>
                                                <li class="nav-item"><a href="{{ route('service-complaints') }}" class="nav-link" data-key="t-service-complaint">Service Complaint</a></li>
                                                <li class="nav-item"><a href="{{ route('complaint-estimates') }}" class="nav-link" data-key="t-complaint-estimate">Complaint and Estimate</a></li>
                                                <li class="nav-item"><a href="{{ route('initial-checks') }}" class="nav-link" data-key="t-initial-check">Initial Check</a></li>
                                                <li class="nav-item"><a href="{{ route('service-reports') }}" class="nav-link" data-key="t-service-reports">Service Reports</a></li>
                                                <li class="nav-item"><a href="{{ route('printable-reports') }}" class="nav-link" data-key="t-printable-reports">Printable Reports</a></li>
                                                <li class="nav-item"><a href="{{ route('risk-agreements') }}" class="nav-link" data-key="t-risks-agreements">Risks Agreements</a></li>
                                                <li class="nav-item"><a href="{{ route('store-item-categories') }}" class="nav-link" data-key="t-item-category">Store Item Category</a></li>
                                                <li class="nav-item"><a href="{{ route('quality-checks') }}" class="nav-link" data-key="t-quality-check">Quality Check (QC)</a></li>
                                                <li class="nav-item"><a href="{{ route('currencies') }}" class="nav-link" data-key="t-currencies">Currencies</a></li>
                                                <li class="nav-item"><a href="{{ route('print-sizes') }}" class="nav-link" data-key="t-print-sizes">Print Sizes</a></li>
                                                <li class="nav-item"><a href="{{ route('device-models') }}" class="nav-link" data-key="t-device-models">Device Models</a></li>
                                                <li class="nav-item"><a href="{{ route('service-customers') }}" class="nav-link" data-key="t-customers">Service Customers</a></li>
                                                <li class="nav-item"><a href="{{ route('outside-service-centers') }}" class="nav-link" data-key="t-outside-center">Outside Service Center</a></li>
                                                <li class="nav-item"><a href="{{ route('store-dealers') }}" class="nav-link" data-key="t-store-dealers">Store Dealers</a></li>
                                                <li class="nav-item"><a href="{{ route('vendors') }}" class="nav-link" data-key="t-vendors">Vendor</a></li>
                                                <li class="nav-item"><a href="{{ route('device-blacklists') }}" class="nav-link" data-key="t-blacklist">Device Black List</a></li>
                                                <li class="nav-item"><a href="{{ route('store-taxes') }}" class="nav-link" data-key="t-store-taxes">Store Taxes</a></li>
                                                <li class="nav-item"><a href="{{ route('units') }}" class="nav-link" data-key="t-units">Units</a></li>
                                                <li class="nav-item"><a href="{{ route('entry-via-options') }}" class="nav-link" data-key="t-entry-options">Entry Via Options</a></li>

                                            </ul>
                                        </div>
                                    </li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-privilege-settings">Privilege Settings</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-branch-register">Branch Register</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-database-backup">Database Backup</a></li>
                                    <li class="nav-item"><a href="#" class="nav-link" data-key="t-support">Support</a></li>
                                </ul>
                            </div>
                        </li>


                    </ul>

                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>