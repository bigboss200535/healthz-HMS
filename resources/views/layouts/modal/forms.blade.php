
    <!-- attendance service_request Modal -->
            <div class="modal fade" id="add_attendance" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                <div class="modal-body">
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <div class="text-center mb-6">
                    <h4 class="address-title mb-2">Patient Attendance Registration</h4>
                    <p class="address-subtitle">Sign in Patient</p>
                    </div>
                    <div class="alert-container"></div>
                    <form id="service_request_form" class="row g-6" onsubmit="return false">
                    @csrf
                    <div id="success_diplay" class="container mt-6"></div>
                    <div hidden>
                        <input type="text" name="patient_id" id="patient_id" placeholder="patient_id">
                        <input type="text" name="service_id" id="service_id" placeholder="service id">
                        <input type="text" name="service_fee_id" id="service_fee_id" placeholder="service fee id">
                        <input type="text" name="top_up" id="top_up" value="0.00" placeholder="top_up">
                        <input type="text" name="opd_number" id="opd_number" placeholder="opd Number">
                    </div>
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
   

    <!-- Vitals Modal -->
            <div class="modal fade" id="add_vitals_signs" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
                <div class="modal-content">
                <div class="modal-body">
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                    <div class="text-center mb-6">
                    <h4 class="address-title mb-2">Patient Vital Signs</h4>
                    <p class="address-subtitle">ADD NEW VITAL SIGNS</p>
                    </div>
                    <div class="alert-container"></div>
                    <form id="vital_signs_forms" class="row g-6" onsubmit="return false">
                    @csrf
                    <div id="success_diplay" class="container mt-6"></div>
                    <div hidden>
                        <input type="text" name="patient_id" id="patient_id" placeholder="patient_id">
                        <input type="text" name="attendance_id" id="attendance_id" placeholder="attendance_id">
                        <input type="text" name="opd_number" id="opd_number" placeholder="opd Number">
                    </div>
                      <!--  -->
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="temperature">Temperature (Degree/fahrenheit)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="temperature" id="temperature" placeholder="Degree">
                            <input type="text" class="form-control" name="fahrenheit" id="fahrenheit" placeholder="Fahrenheit" disabled>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="weight">Weight (Kg)</label>
                        <input type="number" class="form-control" name="weight" id="weight" >
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="respiratory">Respiratory Rate</label>
                         <input type="text" class="form-control" name="respiratory" id="respiratory">
                    </div>
                     <!--  -->
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="pulse">Pulse Rate (Per Minute)</label>
                        <input type="text" id="pulse" name="pulse" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="height">Height (Meters)</label>
                        <input type="number" id="height" name="height" class="form-control" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="bmi">Body Mass Index (BMI)</label>
                        <input type="text" id="bmi" name="bmi" class="form-control" placeholder="0.00"/>
                    </div>
                     <!--  -->
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="fbs">FBS (mmol/L)</label>
                        <input type="text" id="fbs" name="fbs" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="rdt">Rapid Diagnotic Test</label>
                        <input type="text" id="rdt" name="rdt" class="form-control" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="rbs">RBS (mmol/L)</label>
                        <input type="number" id="rbs" name="rbs" class="form-control" />
                    </div>
                    <!--  -->
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="oxygen_saturation">Oxygen Saturation/SPo2 (%)</label>
                           <input type="text" class="form-control" name="oxygen_saturation" id="oxygen_saturation">
                    </div>
                    <div class="col-12 col-md-4">
                         <label class="form-label" for="systolic">Blood Pressure (Systolic/Diastolic)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="systolic" id="systolic">
                            <input type="text" class="form-control" name="dystolic" id="dystolic">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                         <!-- <label class="form-label" for="oxygen_saturation">Blood Pressure (Systolic/Diastolic)</label> -->
                        <label class="form-label" for="service_date">Service Date </label>
                           <input type="date" class="form-control" name="service_date" id="service_date">
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="attendance_type">Remarks/Notes</label>
                        <textarea name="remarks_note" id="remarks_note" class="form-control"></textarea>
                    </div>
                    <!--  -->
                    <div class="col-12">
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3" id="vital_signs_save" name="vital_signs_save">Submit</button>
                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" id="reset_close"><i class="bx bx-trash"></i>Close</button>
                    </div>
                    </form>
                </div>
                </div>
            </div>
            </div>
<!-- /attendance service_request Modal -->
   