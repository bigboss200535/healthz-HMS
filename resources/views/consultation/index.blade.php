<x-app-layout>
 
<div class="container-xxl flex-grow-1 container-p-y">     
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-12">
            <h4 class="text-muted text-center">-Kingly navigate a menu to display attendace-</h4>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
    <div>
    </div>
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-12">
              <div class="col-xl-12">
              <h3>Patients Attendance</h3>
                <div class="nav-align-top nav-tabs-shadow">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        <b>Waiting List</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                        <b>Pending Diagnostics</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                        <b>On Hold</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_completed" aria-controls="navs_completed" aria-selected="false">
                        <b>Completed</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_admission" aria-controls="navs_admission" aria-selected="false">
                        <b>Admission List</b>
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                       <h4>Patient Waiting List</h4>
                       
                       <!-- Add date filter controls -->
                       <div class="row mb-3">
                         <div class="col-md-3">
                           <label for="start_date" class="form-label">Start Date</label>
                           <input type="date" id="start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                         </div>
                         <div class="col-md-3">
                           <label for="end_date" class="form-label">End Date</label>
                           <input type="date" id="end_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                         </div>
                         <div class="col-md-3">
                           <label for="search_waiting" class="form-label">Search</label>
                           <input type="text" id="search_waiting" class="form-control" placeholder="Search by name or OPD #">
                         </div>
                         <div class="col-md-3 d-flex align-items-end">
                           <button id="filter_date" class="btn btn-primary me-2"><i class="bx bx-search"></i> Filter</button>
                           <button id="reset_waiting" class="btn btn-secondary"><i class="bx bx-reset"></i> Reset</button>
                         </div>
                       </div>
                       
                       <table class="table table-responsive" id="app_list">
                           <thead>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            @php
                              $counter = 1;
                            @endphp

                            @foreach($waiting as $wait)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($wait->attendance_date)->format('d-m-Y') }}</td>
                              <td>{{ $wait->fullname }}</td>
                              <td>{{ $wait->opd_number }}</td>
                              <td>
                                  @if(in_array($wait->gender_id, ['2', '3']))
                                      {{ $wait->gender }}
                                  @endif
                              </td>
                              <td>{{ $wait->full_age }}</td>
                              <td> <span class="badge bg-label-info me-1">{{ $wait->sponsor_type }}</span></td>
                              <td>{{ $wait->clinic }}</td>
                              <td class="text-nowrap text-sm-end" align="left">
                                  @if($wait->status === 'Active')
                                  <span class="badge bg-label-info me-1">Active</span>
                                  @elseif ($wait->status === 'Inactive')
                                  <span class="badge bg-label-danger me-1">Inactive</span>
                                  @endif
                              </td>
                              <td class="text-lg-center">
                                  <div class="dropdown" align="center">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                            <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="/consultation/opd-consultation/{{ $wait->attendance_id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Consult
                                                  </a>
                                                  <a class="dropdown-item" href="#" data-id="{{ $wait->attendance_id}}">
                                                    <i class="bx bx-pause me-1"></i> Hold
                                                  </a>
                                                  <a class="dropdown-item product_delete_btn" data-id="{{ $wait->patient_id}}" href="#">
                                                      <i class="bx bx-trash me-1"></i> Delete
                                                  </a>
                                            </div>
                                   </div>  
                              </td>
                          </tr>
                            @endforeach
                           </tbody>
                           <tfoot>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </tfoot>
                       </table>
                    <!-- </p> -->
                    </div>
                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                      <!-- <p> --> <h4>Pending Diagnostics</h4>
                       <!-- Add date filter controls -->
                       <div class="row mb-3">
                         <div class="col-md-3">
                           <label for="start_date_pending" class="form-label">Start Date</label>
                           <input type="date" id="start_date_pending" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                         </div>
                         <div class="col-md-3">
                           <label for="end_date_pending" class="form-label">End Date</label>
                           <input type="date" id="end_date_pending" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                         </div>
                         <div class="col-md-3">
                           <label for="search_pending" class="form-label">Search</label>
                           <input type="text" id="search_pending" class="form-control" placeholder="Search by name or OPD #">
                         </div>
                         <div class="col-md-3 d-flex align-items-end">
                           <button id="filter_date_pending" class="btn btn-primary me-2"><i class="bx bx-search"></i> Filter</button>
                           <button id="reset_pending" class="btn btn-secondary"><i class="bx bx-reset"></i> Reset</button>
                         </div>
                       </div>
                      <table class="table table-responsive" id="diagnostics_list">
                            <thead>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            @php
                              $counter = 1;
                            @endphp

                            @foreach($pending as $pend)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($pend->attendance_date)->format('d-m-Y') }}</td>
                              <td>{{ $pend->fullname }}</td>
                              <td>{{ $pend->opd_number }}</td>
                              <td>
                                  @if(in_array($pend->gender_id, ['2', '3']))
                                      {{ $pend->gender }}
                                  @endif
                              </td>
                              <td>{{ $pend->full_age }}</td>
                              <td> <span class="badge bg-label-info me-1">{{ $pend->sponsor_type }}</span></td>
                              <td>{{ $pend->clinic }}</td>
                              <td class="text-nowrap text-sm-end" align="left">
                                  @if($pend->status === 'Active')
                                  <span class="badge bg-label-info me-1">Active</span>
                                  @elseif ($pend->status === 'Inactive')
                                  <span class="badge bg-label-danger me-1">Inactive</span>
                                  @endif
                              </td>
                              <td class="text-lg-center">
                                  <div class="dropdown" align="center">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                            <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="/consultation/opd-consultation/{{ $pend->attendance_id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Consult
                                                  </a>
                                                  <a class="dropdown-item hold_attendance_btn" href="#">
                                                    <i class="bx bx-pause me-1"></i> Hold
                                                  </a>
                                                  <a class="dropdown-item product_delete_btn" data-id="{{ $pend->patient_id}}" href="#">
                                                      <i class="bx bx-trash me-1"></i> Delete
                                                  </a>
                                            </div>
                                   </div>  
                              </td>
                          </tr>
                            @endforeach
                           </tbody>
                           <tfoot>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </tfoot>
                          </table>
                      <!-- </p> -->
                    </div>
                    <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                      <h4>Patient On Hold</h4>
                      <!-- Add date filter controls -->
                      <div class="row mb-3">
                        <div class="col-md-3">
                          <label for="start_date_onhold" class="form-label">Start Date</label>
                          <input type="date" id="start_date_onhold" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                          <label for="end_date_onhold" class="form-label">End Date</label>
                          <input type="date" id="end_date_onhold" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="col-md-3">
                          <label for="search_onhold" class="form-label">Search</label>
                          <input type="text" id="search_onhold" class="form-control" placeholder="Search by name or OPD #">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                          <button id="filter_date_onhold" class="btn btn-primary me-2"><i class="bx bx-search"></i> Filter</button>
                          <button id="reset_onhold" class="btn btn-secondary"><i class="bx bx-reset"></i> Reset</button>
                        </div>
                      </div>
                      <table class="table table-responsive" id="patient_list">
                            <thead>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                            @php
                              $counter = 1;
                            @endphp

                            @foreach($on_hold as $hold)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($pend->attendance_date)->format('d-m-Y') }}</td>
                              <td>{{ $hold->fullname }}</td>
                              <td>{{ $hold->opd_number }}</td>
                              <td>
                                  @if(in_array($hold->gender_id, ['2', '3']))
                                      {{ $hold->gender }}
                                  @endif
                              </td>
                              <td>{{ $hold->full_age }}</td>
                              <td> <span class="badge bg-label-info me-1">{{ $hold->sponsor_type }}</span></td>
                              <td>{{ $hold->clinic }}</td>
                              <td class="text-nowrap text-sm-end" align="left">
                                  @if($hold->status === 'Active')
                                  <span class="badge bg-label-info me-1">Active</span>
                                  @elseif ($hold->status === 'Inactive')
                                  <span class="badge bg-label-danger me-1">Inactive</span>
                                  @endif
                              </td>
                              <td class="text-lg-center">
                                  <div class="dropdown" align="center">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                            <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="/consultation/opd-consultation/{{ $hold->attendance_id }}">
                                                    <i class="bx bx-edit-alt me-1"></i> Consult
                                                  </a>
                                                  <a class="dropdown-item" href="">
                                                    <i class="bx bx-pause me-1"></i> UnHold
                                                  </a>
                                                  <a class="dropdown-item product_delete_btn" data-id="{{ $hold->patient_id}}" href="#">
                                                      <i class="bx bx-trash me-1"></i> Delete
                                                  </a>
                                            </div>
                                   </div>  
                              </td>
                          </tr>
                            @endforeach
                           </tbody>
                           <tfoot>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </tfoot>
                          </table>
                      <!-- </p> -->
                    </div>
                 
                  <div class="tab-pane fade" id="navs_completed" role="tabpanel">
                       <h4> Consultation Discharged</h4>
                          <table class="table table-responsive" id="patient_services">
                                <thead>
                                  <tr>
                                    <th>Sn</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Clinic</th>
                                    <th>Sponsor Type #</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Sn</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Clinic</th>
                                    <th>Sponsor Type #</th>
                                    <th>Action</th>
                                  </tr>
                                </tfoot>
                              </table>
                      <!-- </p> -->
                    </div>
                    <div class="tab-pane fade" id="navs_admission" role="tabpanel">
                    <h4> Admission List</h4>
                      <table class="table table-responsive" id="patient_sponsor">
                            <thead>
                              <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>        

<!-- Add JavaScript for date filtering -->
<script>

</script>

</x-app-layout>