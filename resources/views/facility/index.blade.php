    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Setup/</span> Facility Setup
                  </h4>
                  <div class="row">
                      <div class="col-12 col-lg-5">
                          <div class="card mb-4">
                            <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Health Facility Setup</b></h5>
                            </div>
                            <div class="card-body">
                              <form id="clinic_form" enctype="multipart/form-data" method="post">
                              @csrf
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_user_name">Facility Name <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_user_name" name="u_user_name" placeholder="Username" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="first_name">Facility Type <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" autocomplete="off">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="other_name">NHIS Accredited <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Othername" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_pass_word">Telephone <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_pass_word" name="u_pass_word" placeholder="*****">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="confirm_pass">Email <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="*****">
                                </div>
                              </div>   
                                 
                                
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_block">Block Status <a style="color: red;">*</a></label>
                                  <select name="status" id="status" class="form-control">
                                    <option disabled selected></option>
                                    <option value="Active">Block</option>
                                    <option value="Inactive">Unblock</option>
                                  </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="status">Status <a style="color: red;">*</a></label>
                                  <select name="status" id="status" class="form-control">
                                    <option disabled selected></option>
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
                        <div class="col-12 col-lg-7">
                          <div class="card mb-4">
                          <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Facility Details</b></h5>
                            </div>
                            <div class="card-body">
                                <table class="datatables-category-list table border-top" id="product_list">
                                    <thead>
                                      <tr>
                                        <!-- <th>Sn</th> -->
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Nhis</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-lg-center"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                         @foreach($facility as $hospital)
                                        <tr>
                                          <td>{{ $hospital->facility_name }}</td>
                                          <td>{{ $hospital->levels }}</td>
                                          <td>{{ $hospital->levels }}</td>
                                          <td><span class="badge bg-label-primary me-1">{{ $hospital->levels }}</span></td>
                                          <td class="text-nowrap text-sm-end" align="left">
                                                @if($hospital->status === 'Active')
                                                 <span class="badge bg-label-success me-1">Active</span>
                                                @elseif ($hospital->status === 'Inactive')
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
                                                        </div>
                                                  </div>  
                                          </td>
                                      </tr>
                                      @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Nhis</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th class="text-lg-center"></th>
                                      </tr>
                                    </tfoot>
                                  </table>
                            </div>
                          </div>
                        </div>
                    </div>
             </div> 
          </div>
    </x-app-layout>