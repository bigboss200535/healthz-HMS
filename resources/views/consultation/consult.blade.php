<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
    
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-12">
            <h4 align="center">-Kingly select a date to display attendace or Create an attendance-</h4>
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
              <h3>Patients List</h3>
                <!-- <h6 class="text-body-secondary">Patients List</h6> -->
                <div class="nav-align-top nav-tabs-shadow">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-top-home"
                        aria-controls="navs-top-home"
                        aria-selected="true">
                        <b>Waiting List</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-top-profile"
                        aria-controls="navs-top-profile"
                        aria-selected="false">
                        <b>Pending Diagnostics</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs-top-messages"
                        aria-controls="navs-top-messages"
                        aria-selected="false">
                        <b>On Hold</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs_completed"
                        aria-controls="navs_completed"
                        aria-selected="false">
                        <b>Completed</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button
                        type="button"
                        class="nav-link"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#navs_admission"
                        aria-controls="navs_admission"
                        aria-selected="false">
                        <b>Admission List</b>
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                       <p>
                         <!-- <a href="/consultation/opd-consultation" class="btn btn-primary rounded-pill">
                           <i class="fas fa-plus"></i> Consult
                         </a> -->
                        <table class="table table-responsive" id="product_list">
                            <thead>
                              <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>OPD #</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Clinic #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                            @php
                              $counter = 1;
                            @endphp

                            @foreach($consult_list as $patients)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ \Carbon\Carbon::parse($patients->attendance_date)->format('d-m-Y') }}</td>
                              <td>{{ $patients->fullname }}</td>
                              <td>{{ $patients->opd_number }}</td>
                              <td>{{ strtoupper($patients->gender) }}</td>
                              <td>{{ $patients->pat_age}}</td>
                              <td>{{ $patients->attendance_type}}</td>
                              <td>{{ $patients->attendance_type}}</td>
                              <td>@if($patients->sponsor_type_id === 'PI03')
                                <span class="badge bg-label-info me-1">{{ $patients->sponsor_type}}</span>
                                @elseif ($patients->sponsor_type_id === 'N002')
                                <span class="badge bg-label-danger me-1">{{ $patients->sponsor_type}}</span>
                                @elseif ($patients->sponsor_type_id === 'P001')
                                <span class="badge bg-label-warning me-1">{{ $patients->sponsor_type}}</span>
                                @elseif ($patients->sponsor_type_id === 'PC04')
                                <span class="badge bg-label-primary me-1">{{ $patients->sponsor_type}}</span>
                                @endif</td>
                              <!-- <td></td> -->
                              <td class="text-lg-center">
                                  <div class="dropdown" align="center">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                            <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="/consultation/opd-consultation/{{$patients->product_id}}">
                                                    <i class="bx bx-edit-alt me-1"></i> Consult
                                                  </a>
                                                  <a class="dropdown-item" href="">
                                                    <i class="bx bx-pause me-1"></i> Hold
                                                  </a>
                                                  <a class="dropdown-item product_delete_btn" data-id="{{ $patients->product_id}}" href="#">
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
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>OPD #</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Clinic #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                                </tr>
                            </tfoot>
                          </table>
                       </p>
                    </div>
                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                      <p>
                      <table class="table table-responsive" id="data_table">
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
                    <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                      <p>
                      <table class="table table-responsive" id="patient_list">
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
                 
                  <div class="tab-pane fade" id="navs_completed" role="tabpanel">
                      <p>
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
                                <!-- <th>Admit Date</th> -->
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
                                <!-- <th>Admit Date</th> -->
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                      </p>
                    </div>
                    <div class="tab-pane fade" id="navs_admission" role="tabpanel">
                      <p>
                      <table class="table table-responsive" id="patient_services">
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
</x-app-layout>