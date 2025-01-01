    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Users/</span> List
                  </h4>
                  <div class="row">
                      <div class="col-12 col-lg-4">
                          <div class="card mb-4">
                            <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Users Setup</b></h5>
                            </div>
                            <div class="card-body">
                              <form id="clinic_form" enctype="multipart/form-data" method="post">
                              @csrf
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_user_name">Username <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_user_name" name="u_user_name" placeholder="Username" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="first_name">Firstname <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" autocomplete="off">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="other_name">Othername <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="other_name" name="other_name" placeholder="Othername Name" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_pass_word">Password <a style="color: red;">*</a></label>
                                  <input type="password" class="form-control" id="u_pass_word" name="u_pass_word" placeholder="*****">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="confirm_pass">Confirm Password <a style="color: red;">*</a></label>
                                  <input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="*****">
                                </div>
                              </div>   
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="status">Gender <a style="color: red;">*</a></label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                  </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="service_name">Email </label>
                                  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Clinic Name">
                                </div>
                              </div>   
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="status">Telephone <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Clinic Name">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="service_name">Role <a style="color: red;">*</a></label>
                                  <select name="user_role" id="user_role" class="form-control">
                                    <option disabled selected>-Select-</option>
                                  </select>
                                </div>
                              </div>  
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="status">Email <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Clinic Name">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="service_name">Status </label>
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
                        <div class="col-12 col-lg-8">
                          <div class="card mb-4">
                          <div class="card-header">
                              <h5 class="card-tile mb-0"><b>User List</b></h5>
                            </div>
                            <div class="card-body">
                                <table class="datatables-category-list table border-top" id="product_list">
                                    <thead>
                                      <tr>
                                        <th>Sn</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Blocked?</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-lg-center">Actions</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                          $counter = 1;
                                        @endphp
                                         @foreach($user as $users)
                                        <tr>
                                          <td>{{ $counter++ }}</td>
                                          <td>{{ $users->user_fullname }}</td>
                                          <td>{{ $users->username }}</td>
                                          <td class="text-nowrap text-sm-end" align="left">
                                                @if($users->locked === 'Yes')
                                                 <span class="badge bg-label-danger me-1">Locked</span>
                                                @elseif ($users->locked === 'No')
                                                 <span class="badge bg-label-info me-1">Unlocked</span>
                                                @endif
                                          </td>
                                          <td>{{$users->role_name}}</td>
                                          <td class="text-nowrap text-sm-end" align="left">
                                                @if($users->status === 'Active')
                                                 <span class="badge bg-label-success me-1">Active</span>
                                                @elseif ($users->status === 'Inactive')
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
                                                              <a class="dropdown-item product_delete_btn" data-id="#" href="#">
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
                                        <th>Username</th>
                                        <th>Blocked?</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-lg-center">Actions</th>
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