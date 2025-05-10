<x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patients /</span> Attendance
                  </h4>
                  <div class="card mb-6">
                    <div class="card-widget-separator-wrapper">
                      <div class="card-body card-widget-separator">
                        <div class="row gy-4 gy-sm-1">
                          <div class="col-sm-6 col-lg-12">
                              <!-- <h4 class="text-muted text-center">-Kingly select a Patient attendance to continue- -->
                               <div class="row mb-3">
                                  <div class="col">
                                    <label class="form-label" for="begin_date">Start Date <a style="color: red;">*</a></label>
                                    <input type="date" class="form-control" id="begin_date" name="begin_date" placeholder="Start End">
                                  </div>
                                  <div class="col">
                                    <label class="form-label" for="last_date">Start Date <a style="color: red;">*</a></label>
                                    <input type="date" class="form-control" id="last_date" name="last_date" placeholder="End Date">
                                  </div>
                                  <div class="col">
                                     <label class="form-label" for="begin_date">. </label><br>
                                    <!-- <div class="d-flex align-content-center flex-wrap gap-3"> -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <!-- <button type="reset" class="btn btn-label-secondary">clear</button> -->
                                  <!-- </div> -->
                                  </div>
                                </div>
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
                      <h4 class="mb-1 mt-3 text-mute">Patient Attendance</h4>
                      </div>
                      <table class="datatables-customers table border-top table-hover" id="app_list">
                          <thead>
                              <tr>
                                  <th>SN</th>
                                  <th>Attendance Date</th>
                                  <th>Patient Name</th>
                                  <th>Patient OPD #</th>
                                  <th>Patient Gender</th>
                                  <th>Patient Age</th>
                                  <th>Attendance Sponsor</th>
                                  <th>Attendance Clinic</th>
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @php
                              $counter = 1;
                            @endphp
                            @foreach($all as $patients)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($patients->attendance_date)->format('d-m-Y') }}</td>
                              <td>{{ $patients->fullname }}</td>
                              <td>{{ $patients->opd_number }}</td>
                              <td>{{ $patients->gender }}</td>
                              <td>{{ $patients->full_age }}</td>
                              <td>
                                  @if($patients->sponsor_type_id === 'PI03')
                                  <span class="badge bg-label-info me-1">{{ $patients->sponsor_name}}</span>
                                  @elseif ($patients->sponsor_type_id === 'N002')
                                  <span class="badge bg-label-success me-1">{{ $patients->sponsor_name}}</span>
                                  @elseif ($patients->sponsor_type_id === 'P001')
                                  <span class="badge bg-label-warning me-1">{{ $patients->sponsor_name}}</span>
                                  @elseif ($patients->sponsor_type_id === 'PC04')
                                  <span class="badge bg-label-primary me-1">{{ $patients->sponsor_name}}</span>
                                  @endif
                              </td>
                              <td>{{ $patients->pat_clinic}}</td>
                              <td>
                                  @if($patients->service_issued === '0')
                                  <span class="badge bg-label-danger me-1">PENDING</span>
                                  @elseif ($patients->service_issued === '1')
                                  <span class="badge bg-label-success me-1">ISSUED</span>
                                  @endif 
                              </td>
                              <td> 
                                <div class="dropdown" align="center">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                            <div class="dropdown-menu">
                                                 
                                                  <a class="dropdown-item" href="/consultation/opd-consultation/{{ $patients->attendance_id }}" >
                                                      <i class="bx bx-edit-alt me-1"></i> Edit Attendance
                                                  </a>
                                                  <a class="dropdown-item attendance_delete_btn" data-id="{{ $patients->attendance_id }}" href="#">
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
                                  <th>Patient Age</th>
                                  <th>Attendance Sponsor</th>
                                  <th>Attendance Clinic</th>
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </tfoot>
                      </table>
                    </div>
            </div>
          </div>
</x-app-layout>
