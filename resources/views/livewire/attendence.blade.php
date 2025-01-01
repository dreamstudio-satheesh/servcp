<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Attendance Register</h5>
        </div>
        <div class="card-body">
            <!-- Date Selector -->
            <div class="mb-3 row">
                <label for="attendanceDate" class="col-sm-2 col-form-label">Select Date:</label>
                <div class="col-sm-4">
                    <input type="text" id="attendanceDate" class="form-control" data-provider="flatpickr"
                        data-date-format="d M, Y" placeholder="Select Date" />
                </div>
            </div>

            <!-- Attendance Table -->
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User Name</th>
                        <th>Morning</th>
                        <th>After Noon</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through Users -->
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- Toggle Button -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input morning-toggle" type="checkbox"
                                        id="morningToggle1" />
                                    <label class="form-check-label" for="morningToggle1">Present</label>
                                </div>

                                <!-- Time Picker -->
                                <div class="ms-3 morning-timepicker" style="display: none;">
                                    <input type="text" class="form-control" data-provider="timepickr"
                                        data-time-basic="true" placeholder="Select Time" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <!-- Toggle Button -->
                                <div class="form-check form-switch">
                                    <input class="form-check-input afternoon-toggle" type="checkbox"
                                        id="afternoonToggle1" />
                                    <label class="form-check-label" for="afternoonToggle1">Present</label>
                                </div>

                                <!-- Time Picker -->
                                <div class="ms-3 afternoon-timepicker" style="display: none;">
                                    <input type="text" class="form-control" data-provider="timepickr"
                                        data-time-basic="true" placeholder="Select Time" />
                                </div>
                            </div>
                        </td>
                    </tr>
                    <!-- Repeat rows for all users -->
                </tbody>
            </table>

            <!-- Save Button -->
            <div class="d-flex justify-content-end">
                <button class="btn btn-success">Save</button>
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener("DOMContentLoaded", function() {

                const date = new Date();
                const hour = date.getHours().toString().padStart(2, '0'); // Format to two digits
                const min = date.getMinutes().toString().padStart(2, '0'); // Format to two digits
                // Initialize Flatpickr for date picker
                flatpickr("[data-provider='flatpickr']", {
                    dateFormat: "Y-m-d",
                    defaultDate: date ,
                });

                // Initialize Timepickr for time pickers
                flatpickr("[data-provider='timepickr']", {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    defaultDate: `${hour}:${min}`, // Set default time to current hour and minute
                });

                // Toggle time picker visibility based on attendance status
                document.querySelectorAll(".morning-toggle").forEach((toggle) => {
                    toggle.addEventListener("change", function() {
                        const timePicker = this.closest("td").querySelector(".morning-timepicker");
                        timePicker.style.display = this.checked ? "block" : "none";
                    });
                });

                document.querySelectorAll(".afternoon-toggle").forEach((toggle) => {
                    toggle.addEventListener("change", function() {
                        const timePicker = this.closest("td").querySelector(".afternoon-timepicker");
                        timePicker.style.display = this.checked ? "block" : "none";
                    });
                });
            });
        </script>
    @endpush
</div>
