    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Users/</span> List
                  </h4>

                  <div class="app-ecommerce-category">
                  <div class="card">
                    <div class="card-datatable table-responsive">
                      <div style="margin:15px">
                        <a class="btn btn-primary me-sm-3 me-1" href="#">Add New User</a>
                      </div>
                      <table class="datatables-category-list table border-top" id="product_list">
                        <thead>
                          <tr>
                            <th>Sn</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Telephone</th>
                            <th>Gender &nbsp;</th>
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
                                  <td>{{ $users->telephone }}</td>
                                  <td>{{$users->gender}}</td>
                                  <td>{{$users->role_name}}</td>
                                  <td class="text-nowrap text-sm-end" align="left">
                                    @if($users->status === 'Active')
                                    <span class="badge bg-label-info me-1">Active</span>
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
                                                          <i class="bx bx-edit-alt me-1"></i> More
                                                        </a>
                                                        <a class="dropdown-item product_delete_btn" data-id="{{ $users->user_id}}" href="#">
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
                            <th>Name</th>
                            <th>Username</th>
                            <th>Telephone</th>
                            <th>Gender &nbsp;</th>
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
    </x-app-layout>