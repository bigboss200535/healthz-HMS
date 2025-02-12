<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        </div>
  <div class="row">
   <div class="col-12 col-lg-8">
    <div class="nav-align-top nav-tabs-shadow mb-6">
      <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#nav_home" aria-controls="navs-justified-home" aria-selected="true">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i> 
              Bio Info 
            </span>
            <i class="bx bx-home bx-sm d-sm-none"></i>
          </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_sponsor" aria-controls="navs-justified-profile" aria-selected="false">
              <span class="d-none d-sm-block">
                <i class="tf-icons bx bx-money-withdraw bx-sm me-1_5 align-text-bottom"></i> 
                Sponsor
              </span>
              <i class="bx bx-user bx-sm d-sm-none"></i>
            </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_attendance" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-timer bx-sm me-1_5 align-text-bottom"></i> Attendance
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_medications" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-time bx-sm me-1_5 align-text-bottom"></i> Appointments
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_claims_code" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-layer bx-sm me-1_5 align-text-bottom"></i> Claims Code
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="nav_home" role="tabpanel">
          <p>
              <!-- <div class="card-header">
                  <h5 class="card-tile mb-0 text-primary"><b>BIO-INFORMATION</b></h5>
              </div> -->
                <table class="table">
                    <tr>
                       <td colspan="2">
                          <h5 class="text-primary"><b>BIO-INFORMATION</b></h5>
                       </td>
                    </tr>
                    <tr>
                      <td><b>Fullname</b></td>
                      <td>{{ $patients->fullname }}</td>
                    </tr>
                    <tr>
                      <td><b>Gender</b></td>
                      <td>{{ strtoupper($patients->gender) }}</td>
                    </tr>
                    <tr>
                      <td><b>Age</b></td>
                      <td>{{ $age_full }}</td>
                    </tr>
                     <tr>
                       <td colspan="2">
                          <h5 class="text-primary"><b>CONTACT</b></h5>
                       </td>
                     </tr>
                     <tr>
                        <td><b>Email</b></td>
                        <td>{{ $patients->email }}</td>
                      </tr>
                      <tr>
                        <td><b>Address</b></td>
                        <td>{{ $patients->address }}</td>
                      </tr>
                      <tr>
                        <td><b>Telephone</b></td>
                        <td>{{ $patients->telephone }}</td>
                      </tr>
                      <tr>
                        <td colspan="2">
                          <h5 class="text-primary"><b>EMERGENCY CONTACT PERSON</b></h5>
                        </td>
                      </tr>
                      <tr>
                        <td><b>Fullname</b></td>
                        <td>{{ $patients->contact_person }}</td>
                      </tr>
                      <tr>
                        <td><b>Telephone</b></td>
                        <td>{{ $patients->contact_telephone }}</td>
                      </tr>
                      <tr>
                        <td><b>Relationship</b></td>
                        <td>{{ $patients->contact_relationship}}</td>
                      </tr>
                    </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_sponsor" role="tabpanel">
          <p>
            <div>
              <h5>Sponsors</h5>
                <div class="pull-right">
                    <a href="#" class="btn btn-info pull-right" id="clear_search">Add Sponsor</a>
                </div>
            </div>
              
            <table class="table table-hover" id="data_table">
              <thead>
                <tr>
                  <th>Sponsor Type</th>
                  <th>Member #</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Sponsorhip Status</th>
                  <th>Prority Sponsor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                     
              </tbody>
              <tfoot>
                <tr>
                <th>Sponsor Type</th>
                  <th>Member #</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Sponsorhip Status</th>
                  <th>Prority Sponsor</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_attendance" role="tabpanel">
        <p>
            <div>
              <h5>Attendance History</h5>
            </div>
            <table class="table table-hover" id="employee_details">
              <thead>
                <tr>
                  <th>Attendance #</th>
                  <th>Attendance Date</th>
                  <th>Clinic</th>
                  <th>Sponsor</th>
                  <th>Status</th>
                  <!-- <th>is NHIS</th> -->
                  <th>Outcome</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                            @php
                              $counter = 1;
                            @endphp
                            @foreach($service_requests  as $old_requests)
                            <tr>
                                <td><a href="#">{{ $old_requests->attendance_id}}</a></td>
                                <td>{{ \Carbon\Carbon::parse($old_requests->attendance_date)->format('d-m-Y') }}</td>
                                <td>{{ $old_requests->attendance_type }}</td>
                                <td>{{ $old_requests->sponsor_type }}</td>
                                <td><span class="badge bg-label-danger me-1">OPD</span></td> <!--   IPD or OPD-->
                                <!-- <td><span class="badge bg-label-warning me-1">NO</span></td> -->
                                <td><span class="badge bg-label-info me-1">DISCHARGED</span></td>
                                <td>
                                      <div class="dropdown" align="center">
                                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                              </button>
                                              <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">
                                                        <i class="bx bx-lock-alt me-1"></i> Details 
                                                    </a>
                                              </div>
                                      </div>
                                 </td>
                            </tr>
                        @endforeach
             </tbody>
              <tfoot>
                <tr>
                  <th>Attendance #</th>
                  <th>Attendance Date</th>
                  <th>Clinic</th>
                  <th>Sponsor</th>
                  <th>Status</th>
                  <!-- <th>is NHIS</th> -->
                  <th>Outcome</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_medications" role="tabpanel">
        <p>
            <div>
              <h5>Appointments History</h5>
            </div>
            <table class="table table-hover" id="app_list">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
       
        <div class="tab-pane fade" id="nav_claims_code" role="tabpanel">
        <p>
            <div>
              <h5>Claims Code History</h5>
            </div>
            <table class="table table-hover" id="claims_code_list">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </thead>
             
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
       
      </div>
    </div>
  </div>
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb 3">
                <!-- <h5 class="card-tile mb-0"><b>Sponsorship Details</b></h5> -->
          </div>
          <!-- <br> -->
           <div class="mb-3 col ecommerce-select2-dropdown" align="center">
            <img src="{{ $patients->gender==='Female' ? asset('img/avatars/female.jpg') : asset('img/avatars/male.jpg') }}" alt="Patient Image" class="rounded-pill" style="border:1px;border-color:black; box-shadow:10px ">
          </div>
          <div class="mb-3 col ecommerce-select2-dropdown" align="center">
            <h5 class="card-tile mb-0"><b>{{ $patients->title}}. {{ $patients->fullname }}</b></h5>
          </div>
          <div class="mb-3 col ecommerce-select2-dropdown">
           <table class="table">
            <tr>
              <td><b>Folder #</b>:</td>
              <td>{{ $patients->opd_number }}</td>
            </tr>
            <tr>
              <td><b>Date Registered</b>:</td>
              <td>{{ \Carbon\Carbon::parse($patients->added_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
              <td><b>Blood Group</b>:</td>
              <td><span class="badge bg-label-info me-1">AB-</span></td>
            </tr>
            <tr>
              <td><b>Sickling</b>:</td>
              <td>Negative</td>
            </tr>
            <!-- <tr>
              <td><b>Allergy</b>:</td>
              <td>Negative</td>
            </tr> -->
            <tr>
              <td><b>Registered By</b>:</td>
              <td>{{ $patients->user_fullname}}</td>
            </tr>
            <tr>
              <td><b>Deceased</b>:</td>
              <td><span class="badge bg-label-danger me-1">{{ $patients->death_status}}</span></td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                <div class="btn-group">
                        <button type="button" data-bs-toggle='modal' data-bs-target="#claims_check_code" class="btn btn-sm btn-info">GET CCC </button>
                        <button type="button" class="btn btn-sm btn-warning edit-btn">EDIT PATIENT</button>
                        <button type="button" data-bs-toggle='modal' data-bs-target="#addattendance" class="btn btn-sm btn-primary">NEW ATTENDANCE</button>
                </div>
              </td>
                 <!-- <td colspan="2">
                    <a href="#" class="btn btn-secondary" data-bs-toggle='modal' data-bs-target="#claims_check_code"><i class="bx bx-plus"></i> C.C</a>
                    <a href="#" class="btn btn-warning"><i class="bx bx-pencil"></i> Edit</a>
                    <a href="#" class="btn btn-primary" data-bs-toggle='modal' data-bs-target="#addattendance"><i class="bx bx-plus"></i> Visit</a>
                </td> -->
            </tr>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
      <div class="app-ecommerce-category">
                  <div class="card">
                    <div class="card-datatable table-responsive">
                      <div style="margin:15px">
                        <h5>Patient Attendance</h5>
                      </div>
                      <table class="datatables-category-list table border-top" id="patient_services">
                        <thead>
                          <tr class="" align="center">
                            <!-- <th>S/N</th>   -->
                            <th>Attendance ID</th>
                            <th>Attendate Date</th>
                            <th>Clinic</th>
                            <th>Sponsor</th>
                            <th>Age</th>
                            <th>Sponsor &nbsp;</th>
                            <th>Service Fee</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                        <tfoot>
                          <tr class="" align="center">
                              <!-- <th>S/N</th>   -->
                              <th>Att ID</th>
                              <th>Attendate Date</th>
                              <th>Clinic</th>
                              <th>Gender</th>
                              <th>Age</th>
                              <th>Sponsor &nbsp;</th>
                              <th>Service Fee</th>
                              <th>Status</th>
                              <th>Actions</th>
                            </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>   
             </div>
</div>   
<!-----------****************************----------------------------------------------------------->
<!-- service_request Modal -->
<div class="modal fade" id="addattendance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="address-title mb-2">Patient Attendance Registration</h4>
          <p class="address-subtitle">ADD NEW PATIENT ATTENDANCE</p>
        </div>
          <div class="alert-container"></div>
        <form id="service_request_form" class="row g-6" onsubmit="return false">
          @csrf
          <div id="success_diplay" class="container mt-6"></div>
          <div class="col-12 col-md-12">
            <!-- <label class="form-label" for="credit_amount">Fullname</label> -->
            <!-- <input type="text" id="fullname" name="fullname" class="form-control" value="{{ strtoupper($patients->fullname) }}" disabled/> -->
          </div>
            <input type="text" name="patient_id" id="patient_id" value="{{ $patients->patient_id }}">
            <input type="text" name="service_id" id="service_id">
            <input type="text" name="service_fee_id" id="service_fee_id">
            <!-- <input type="text" name="full_age" id="full_age" value="{{ $age_full }}"> -->
            <!-- <input type="text" name="top_up" id="top_up"> -->
            <input type="text" name="opd_number" id="opd_number" value="{{ $patients->opd_number}}">
          <div class="col-12 col-md-6">
            <label class="form-label" for="clinic_code">Service Clinic</label>
             <select name="clinic_code" id="clinic_code" class="form-control">
                <option>-Select-</option>
                @foreach($clinic_attendance as $clinics)                                        
                  <option value="{{ $clinics->service_point_id }}">{{ $clinics->service_points }}</option>
                 @endforeach
             </select>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="service_type">Service Type</label>
            <select name="service_type" id="service_type" class="form-control">
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
                <select name="attendance_type" id="attendance_type" class="form-control">
                  <option selected disabled>-Select-</option>
                  <option value="NEW">NEW</option>
                  <option value="OLD">OLD</option>
                </select>
          </div>
          <div class="col-12">
            <div class="form-check form-switch my-2 ms-2">
            </div>
          </div>
          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-3">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ service_request Modal -->
 <!------------------------------------------****************************----------------------------------------------------------->

 <!-- check claims code Modal -->
<div class="modal fade" id="claims_check_code" tabindex="-1" aria-hidden="true" data-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-simple modal-add-new-address">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="text-center mb-6">
          <h4 class="address-title mb-2">Patient NHIS Verification</h4>
          <!-- <p class="address-subtitle">Click on the generate to get CCC or enter it in the CCC input box</p> -->
          <p class="address-subtitle" id="error" style="color:red"></p>
        </div>
        <form id="generate_ccc" class="row g-6" onsubmit="return false">
           @csrf
          <div class="col-12 col-md-6">
            <label class="form-label" for="credit_amount">Member #</label>
            <input type="text" name="card_type" id="card_type" hidden value="NHISCARD">
            <input type="text" id="member_no" name="member_no" class="form-control" placeholder="12345678"/>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="cash_amount">Claims Check Code (CCC) <a href="#" style="color: red;">*</a></label>
            <input type="text" id="claim_code" name="claim_code" class="form-control" placeholder="xxxxx" maxlength="5" required readonly/>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="gdrg_code"> Start Date <a href="#" style="color: red;">*</a></label>
            <input type="date" id="start_date" name="start_date" class="form-control" />
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="modalAddressZipCode">End Date <a href="#" style="color: red;">*</a></label>
            <input type="date" id="end_date" name="end_date" class="form-control"/>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="gdrg_code"> HIN # <a href="#" style="color: red;">*</a></label>
            <input type="text" id="hin_no" name="hin_no" class="form-control" readonly/>
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="status">Status </label>
            <input type="text" id="card_status" name="card_status" class="form-control" readonly/>
          </div>
          <div class="col-12 col-md-12">
            <label class="form-label">NHIS Registration Name</label>
              <input type="text" name="fullname" id="fullname" class="form-control" disabled>
          </div>
          <br>
          <div class="col-12 text-center">
          <button type="button" class="btn btn-label-info" onclick="generateCC()">Generate CC</button>
            <button type="submit" class="btn btn-primary me-3">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!--/ service_request Modal -->
 <!-- ----------------------------------------****************************---------------------------------------------------------- -->
</x-app-layout>