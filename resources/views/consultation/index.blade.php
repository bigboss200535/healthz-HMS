    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Consultations/</span> Waiting List
                  </h4>

                  <div class="app-ecommerce-category">
                  <div class="card">
                    <div class="card-datatable table-responsive">
                      <div style="margin:15px">
                        <!-- <a class="btn btn-primary me-sm-3 me-1" href="#">Add New Service</a> -->
                      </div>
                      <table class="datatables-category-list table border-top" id="product_list">
                        <thead>
                          <tr>
                            <th>Sn</th>
                            <th>Fullname</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Sponsor &nbsp;</th>
                            <th>Clinic</th>
                            <th>Vitals?</th>
                            <th>Assigned?</th>
                            <th class="text-lg-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                           @php
                              $counter = 1;
                            @endphp

                            @foreach($pat_req as $patients)
                            <tr>
                              <td>{{ $counter++ }}</td>
                              <td>{{ $patients->fullname }}</td>
                              <td>
                                  @if(in_array($patients->gender_id, ['2', '3']))
                                      {{ $patients->gender }}
                                  @endif
                              </td>
                              <td>{{ $patients->pat_ages }}</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td class="text-nowrap text-sm-end" align="left">
                                @if($patients->status === 'Active')
                                <span class="badge bg-label-info me-1">Yes</span>
                                @elseif ($patients->status === 'Inactive')
                                <span class="badge bg-label-danger me-1">No</span>
                                @endif
                              </td>
                              <td class="text-lg-center">
                                  <div class="dropdown" align="center">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                              <i class="bx bx-dots-vertical-rounded"></i>
                                          </button>
                                            <div class="dropdown-menu">
                                                  <a class="dropdown-item" href="">
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
                            <th>Fullname</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Sponsor &nbsp;</th>
                            <th></th>
                            <th>Vitals?</th>
                            <th>Assigned?</th>
                            <th class="text-lg-center">Actions</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                  </div>   
             </div>
          </div>
          <!-- product modal form -->
          <!-- end of product modal form -->
    </x-app-layout>