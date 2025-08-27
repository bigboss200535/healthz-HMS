<x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patients /</span> Appointments
                  </h4>
                  <div class="card mb-6">
                    <div class="card-widget-separator-wrapper">
                      <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                          <div class="col-sm-6 col-lg-12">
                              <!-- <h4 class="text-muted text-center">-Kingly select a Patient attendance to continue- -->
                               <form action="{{ route('appointments.index') }}" method="GET">
                                <div class="row mb-3">
                                  <div class="col">
                                    <label class="form-label" for="appoint_start_date">Start Date <a style="color: red;">*</a></label>
                                    <input type="date" class="form-control" id="appoint_start_date" name="appoint_start_date" placeholder="Start End" value="{{ request('start_date', date('Y-m-d')) }}">
                                  </div>
                                  <div class="col">
                                    <label class="form-label" for="appoint_end_date">End Date <a style="color: red;">*</a></label>
                                    <input type="date" class="form-control" id="appoint_end_date" name="appoint_end_date" placeholder="End Date" value="{{ request('end_date', date('Y-m-d')) }}">
                                  </div>
                                  <div class="col">
                                    <label class="form-label" for="search">Search</label>
                                    <input type="text" class="form-control" id="search" name="search" placeholder="Search by name or OPD #" value="{{ request('search') }}">
                                  </div>
                                  <div class="col">
                                     <label class="form-label" for="begin_date">. </label><br>
                                    <!-- <div class="d-flex align-content-center flex-wrap gap-3"> -->
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="{{ route('appointments.index') }}" class="btn btn-label-secondary">Reset</a>
                                    <!-- </div> -->
                                  </div>
                                </div>
                                </form>
                              </h4>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <br>
                <div class="card" id="patient_search_result" >
                    <div class="card-datatable table-responsive">
                      <div class="col" style="padding-left:20px;"> 
                      <h4 class="mb-1 mt-3 text-mute">Patient Appointments</h4>
                      </div>
                      <table class="datatables-customers table border-top table-hover" id="system_table">
                          <thead>
                              <tr>
                                  <th>SN</th>
                                  <th>Attendance Date</th>
                                  <th>Patient Name</th>
                                  <th>Patient OPD #</th>
                                  <th>Patient Gender</th>
                                  <th>Attendance Clinic</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @php
                              $counter = 1;
                            @endphp
                            @foreach($appointments as $appointment)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d-m-Y') }}</td>
                              <td>{{ strtoupper($appointment->fullname) }}</td>
                              <td>{{ $appointment->opd_number }}</td>
                              <td>{{ $appointment->gender }}</td>
                              <!-- <td>{{ $appointment->full_age }}</td> -->
                              <td>{{ $appointment->purpose}}</td>
                              <td> 
                                <div class="dropdown" align="center">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                            <div class="dropdown-menu">
                                                 
                                                  <a class="dropdown-item" href="#" >
                                                      <i class="bx bx-edit-alt me-1"></i> Edit Attendance
                                                  </a>
                                                   <a class="dropdown-item" href="#" >
                                                      <i class="bx bx-refresh me-1"></i> Re-Schedule
                                                  </a>
                                                  <a class="dropdown-item attendance_delete_btn" data-id="{{ $appointment->attendance_id }}" href="#">
                                                      <i class="bx bx-trash me-1"></i> Delete Attendance
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
                                  <th>Attendance Date</th>
                                  <th>Patient Name</th>
                                  <th>Patient OPD #</th>
                                  <th>Patient Gender</th>
                                  <th>Attendance Clinic</th>
                                  <th></th>
                              </tr>
                          </tfoot>
                      </table>
                    </div>
            </div>
          </div>
</x-app-layout>
