<x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Clinic/</span> Setup
                  </h4>
                  <div class="row">
                      <div class="col-12 col-lg-6">
                          <div class="card mb-4">
                            <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Clinic Setup</b></h5>
                            </div>
                            <div class="card-body">
                              <form id="clinic_form" enctype="multipart/form-data" method="post">
                              @csrf
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="service_name">Clinic Name <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Clinic Name">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="status">Clinic Status <a style="color: red;">*</a></label>
                                  <select name="status" id="status" class="form-control">
                                    <option disabled selected>-Select-</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                  </select>
                                </div>
                              </div>     
                                  <div class="d-flex align-content-center flex-wrap gap-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary">clear</button>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-12 col-lg-6">
                          <div class="card mb-4">
                          <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Clinic List</b></h5>
                            </div>
                            <div class="card-body">
                                <table class="datatables-category-list table border-top" id="product_list">
                                    <thead>
                                      <tr>
                                        <th>Sn</th>
                                        <th>Clinic</th>
                                        <th>Date Added</th>
                                        <th>Status</th>
                                        <th class="text-lg-center">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                          $counter = 1;
                                        @endphp
                                        @foreach($clinic as $clinics)
                                        <tr>
                                          <td>{{ $counter++ }}</td>
                                          <td>{{ $clinics->clinic }}</td>
                                          <td>{{ \Carbon\Carbon::parse($clinics->added_date)->format('d-m-Y') }}</td>
                                          <td class="text-nowrap text-sm-end" align="left">
                                                @if($clinics->status === 'Active')
                                                 <span class="badge bg-label-info me-1">Active</span>
                                                @elseif ($clinics->status === 'Inactive')
                                                 <span class="badge bg-label-danger me-1">Inactive</span>
                                                @endif
                                          </td>
                                          <td class="text-lg-center">
                                                <div class="dropdown" align="center">
                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                          <i class="bx bx-dots-vertical-rounded"></i>
                                                      </button>
                                                        <div class="dropdown-menu">
                                                              <a class="dropdown-item" href="">
                                                                <i class="bx bx-edit-alt me-1"></i> Edit
                                                              </a>
                                                              <a class="dropdown-item product_delete_btn" data-id="{{ $clinics->clinic_id }}" href="#">
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
                                        <th>Clinic</th>
                                        <th>Date Added</th>
                                        <th>Status</th>
                                        <th class="text-lg-center">Actions</th>
                                      </tr>
                                    </tfoot>
                                  </table>
                            </div>
                          </div>
                        </div>
                      </div>
                  <!-- <div class="app-ecommerce-category"> -->
             
             </div>
          </div>
    </x-app-layout>