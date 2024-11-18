    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patient /</span> Registered
                  </h4>  
                  <div class="card">
                    <div class="card-datatable table-responsive">
                      <div class="col" style="padding-left:20px;"> 
                      <h4 class="mb-1 mt-3">Patient List</h4>
                      </div>
                      <table class="datatables-customers table border-top" id="patient_list">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Age</th>
                            <th>Telephone</th>
                            <th>Added Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @php
                              $counter = 1;
                            @endphp
                          @foreach($patient_list as $patient)
                          <tr> 
                              <td align="center">{{ $counter++ }}</td>
                              <td><a href="{{ $patient->patient_id }}">{{ $patient->fullname }}</a></td>
                              <td>{{ $patient->gender }}</span></td>
                              <td>{{ $patient->email }}</td>
                              <td>{{$patient->age }}</td>
                              <td>{{$patient->telephone }}</td>
                              <td>{{ \Carbon\Carbon::parse($patient->added_date)->format('d-m-Y') }}</td>
                              <td>
                                    @if($patient->sponsor_type_id === 'PI03')
                                      <span class="badge bg-label-info me-1">{{$patient->sponsor_type}}</span>
                                    @elseif ($patient->sponsor_type_id === 'N002')
                                      <span class="badge bg-label-danger me-1">{{$patient->sponsor_type}}</span>
                                    @elseif ($patient->sponsor_type_id === 'PC04')
                                      <span class="badge bg-label-primary me-1">{{$patient->sponsor_type}}</span>
                                    @endif
                              </td>
                              <td>
                                <div class="dropdown" align="center">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                              <div class="dropdown-menu">
                                                  <a class="dropdown-item"  href="#">
                                                    <i class="bx bx-edit-alt me-1"></i> Edit
                                                  </a>
                                                  <a class="dropdown-item" href="javascript:void(0);">
                                                      <i class="bx bx-trash me-1"></i> Delete
                                                  </a>
                                                  <a class="dropdown-item" href="{{ route('patients.show', ['patient' => $patient->patient_id]) }}">
                                                    <i class="bx bx-lock-alt me-1"></i> More 
                                                  </a>
                                            </div>
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                              <th>S/N</th>
                              <th>Name</th>
                              <th>Gender</th>
                              <th>Email</th>
                              <th>Age</th>
                              <th>Telephone</th>
                              <th>Added Date</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
            </div>
          </div>
</x-app-layout>