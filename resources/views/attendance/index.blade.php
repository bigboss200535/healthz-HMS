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
                              <form action="{{ route('attendance.index') }}" method="GET">
                                <div class="row mb-3">
                                  <div class="col">
                                    <label class="form-label" for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="attend_start_date" name="attend_start_date" value="{{ request('attend_start_date', date('Y-m-d')) }}">
                                  </div>
                                  <div class="col">
                                    <label class="form-label" for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="attend_end_date" name="attend_end_date" value="{{ request('attend_end_date') }}">
                                  </div>
                                  <div class="col">
                                    <label class="form-label" for="search">Search (Name or OPD #)</label>
                                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Search by name or OPD number">
                                  </div>
                                  <div class="col">
                                     <label class="form-label" for="begin_date">. </label><br>
                                    <div class="d-flex align-content-center flex-wrap gap-3">
                                      <button type="submit" class="btn btn-primary">Filter</button>
                                      <a href="{{ route('attendance.index') }}" class="btn btn-label-secondary">Reset</a>
                                    </div>
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
                      <h4 class="mb-1 mt-3 text-mute">Patient Attendance</h4>
                      </div>
                      <table class="datatables-customers table border-top table-hover" id="system_table">
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
                                  <th>Added By</th>
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            @php
                              $counter = 1;
                            @endphp
                            @foreach($all_attendance as $patients)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($patients->attendance_date)->format('d-m-Y') }}</td>
                              <td>{{ strtoupper($patients->fullname) }}</td>
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
                              <td>{{ $patients->type_of_attendance}}</td>
                              <td>{{ strtoupper($patients->user_fullname) }}</td>
                              <td><span class="badge bg-label-{{ $patients->color_code }} me-1">{{ strtoupper($patients->issue_value) }}</span></td>
                              <td> 
                                <div class="dropdown" align="center">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                      </button>
                                            <div class="dropdown-menu">
                                                   @if($patients->issue_id === '0') <!--pending-->
                                                    <a class="dropdown-item" href="/consultation/opd-consultation/{{ $patients->attendance_id }}" >
                                                          <i class="bx bx-edit-alt me-1"></i> Consult
                                                      </a>
                                                      <a class="dropdown-item attendance_delete_btn" data-id="{{ $patients->attendance_id }}" href="#">
                                                          <i class="bx bx-trash me-1"></i> Delete
                                                      </a>
                                                   @elseif ($patients->issue_id === '1') <!--issued-->
                                                      <a class="dropdown-item" href="/consultation/opd-consultation/{{ $patients->attendance_id }}" >
                                                          <i class="bx bx-edit-alt me-1"></i> View
                                                      </a>
                                                      <a class="dropdown-item attendance_delete_btn" data-id="{{ $patients->attendance_id }}" href="#">
                                                          <i class="bx bx-trash me-1"></i> Delete
                                                      </a>
                                                   @elseif ($patients->issue_id === '2') <!--waiting-->
                                                      <a class="dropdown-item" href="/consultation/opd-consultation/{{ $patients->attendance_id }}" >
                                                          <i class="bx bx-edit-alt me-1"></i> Consult
                                                      </a>
                                                       <a class="dropdown-item attendance_delete_btn" data-id="{{ $patients->attendance_id }}" href="#">
                                                          <i class="bx bx-trash me-1"></i> Delete
                                                      </a>
                                                    @elseif ($patients->issue_id === '3') <!--completed-->
                                                      <a class="dropdown-item" href="/consultation/opd-consultation/{{ $patients->attendance_id }}" >
                                                          <i class="bx bx-edit-alt me-1"></i> View
                                                      </a>
                                                      <a class="dropdown-item attendance_delete_btn" data-id="{{ $patients->attendance_id }}" href="#">
                                                          <i class="bx bx-trash me-1"></i> Delete
                                                      </a>
                                                    @elseif ($patients->issue_id === '4') <!--on hold-->
                                                      <a class="dropdown-item" href="/consultation/opd-consultation/{{ $patients->attendance_id }}" >
                                                          <i class="bx bx-edit-alt me-1"></i> Unhold
                                                      </a>
                                                      <a class="dropdown-item attendance_delete_btn" data-id="{{ $patients->attendance_id }}" href="#">
                                                          <i class="bx bx-trash me-1"></i> Delete
                                                      </a>
                                                  @endif
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
                                  <th>Added By</th>
                                  <th>Status</th>
                                  <th></th>
                              </tr>
                          </tfoot>
                      </table>
                    </div>
            </div>
          </div>
</x-app-layout>
