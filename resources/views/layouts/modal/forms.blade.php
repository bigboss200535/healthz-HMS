
    <!-- attendance service_request Modal -->
            <div class="modal fade" id="add_attendance" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                <div class="modal-body">
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <div class="text-center mb-6">
                    <h4 class="address-title mb-2">Patient Attendance Registration</h4>
                    <p class="address-subtitle">ADD NEW PATIENT ATTENDANCE</p>
                    </div>
                    <div class="alert-container"></div>
                    <form id="service_request_form" class="row g-6" onsubmit="return false">
                    @csrf
                    <div id="success_diplay" class="container mt-6"></div>
                    <!-- <div> -->
                        <input type="text" name="patient_id" id="patient_id" placeholder="patient_id">
                        <input type="text" name="service_id" id="service_id" placeholder="service id">
                        <input type="text" name="service_fee_id" id="service_fee_id" placeholder="service fee id">
                        <input type="text" name="top_up" id="top_up" value="0.00" placeholder="top_up">
                        <input type="text" name="opd_number" id="opd_number" placeholder="opd Number">
                    <!-- </div> -->
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="service_point_id">Service Clinic</label>
                        <select name="service_point_id" id="service_point_id" class="form-control">
                            <option>-Select-</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="attendance_type_id">Service Type</label>
                        <select name="attendance_type_id" id="attendance_type_id" class="form-control">
                            <option disabled selected></option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="credit_amount">Credit Fee</label>
                        <input type="text" id="credit_amount" name="credit_amount" class="form-control" placeholder="0.00"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="cash_amount">Cash Fee</label>
                        <input type="text" id="cash_amount" name="cash_amount" class="form-control" placeholder="0.00"/>
                    </div>
                    <div class="col-12 col-md-6" hidden>
                        <label class="form-label" for="gdrg_code">Service G-DRG</label>
                        <input type="text" id="gdrg_code" name="gdrg_code" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="attendance_date">Attendance Date</label>
                        <input type="date" id="attendance_date" name="attendance_date" class="form-control" />
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="attendance_type">Attendance Type</label>
                            <select name="attendance_type" id="attendance_type" class="form-control" required>
                            <option value="NEW">NEW</option>
                            <option value="OLD">OLD</option>
                            </select>
                    </div>
                    <div class="col-12">
                        <!-- <div class="form-check form-switch my-2 ms-2">
                        </div> -->
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3" id="service_request_save" name="service_request_save">Submit</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" id="reset_close"><i class="bx bx-trash"></i>Close</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
<!-- /attendance service_request Modal -->
   