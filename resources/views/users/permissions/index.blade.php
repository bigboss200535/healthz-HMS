    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Users/</span> Permissions
                  </h4>
                  <div class="row">
                        <div class="col-12 col-lg-12">
                          <div class="card mb-4">
                          <div class="card-header">
                              <h5 class="card-tile mb-0">Permissions For <br> <b>{{ strtoupper($user->user_fullname) }}</b> <br>{{$user->role_type}}</h5>
                            </div>
                            <div class="card-body">
                                <div class="pull-right">
                                    <button class="btn btn-primary" name="add_permissions" id="add_permissions"><i class="bx bx-plus"></i> New Permission</button>
                                </div>
                                <br>
                                <table class="datatables-category-list table border-top" id="app_list">
                                    <thead>
                                      <tr>
                                        <th>Assign</th>
                                        <th>Role Type</th>
                                        <th>Permission Type</th>
                                        <th>Can View</th>
                                        <th>Can Add</th>
                                        <th>Can Delete</th>
                                        <th>Can Edit</th>
                                        <th class="text-lg-center">Action</th>
                                      </tr>
                                    </thead>
                                        <tbody>
                                        @foreach($permissions as $permission)
                                        <tr>
                                            <td align="center">
                                                @if($permission->is_granted)
                                                <input type="checkbox" checked>
                                                @else
                                                <input type="checkbox" >
                                                @endif  
                                            </td>
                                            <td>{{ $permission->role_name }}</td>
                                            <td>{{ $permission->permission_name }}</td>
                                            <td>
                                                @if($permission->can_read==='1')
                                                 <input type="checkbox" checked>
                                                @elseif($permission->can_read==='0')
                                                 <input type="checkbox" >
                                                @endif  
                                            </td>
                                            <td>
                                               @if($permission->can_create==='1')
                                                 <input type="checkbox" checked>
                                                @elseif($permission->can_create==='0')
                                                 <input type="checkbox" >
                                                @endif 
                                            </td>
                                            <td>@if($permission->can_delete==='1')
                                                 <input type="checkbox" checked>
                                                @elseif($permission->can_delete==='0')
                                                 <input type="checkbox" >
                                                @endif 
                                              </td>
                                            <td>
                                            @if($permission->can_update==='1')
                                                 <input type="checkbox" checked>
                                                @elseif($permission->can_update==='0')
                                                 <input type="checkbox" >
                                                @endif 
                                            </td>
                                            <td>
                                                 <div class="dropdown" align="center">
                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                          <i class="bx bx-dots-vertical-rounded"></i>
                                                      </button>
                                                        <div class="dropdown-menu">
                                                              <a class="dropdown-item product_delete_btn" data-id="#" href="#">
                                                                  <i class="bx bx-edit me-1"></i> Edit
                                                              </a>
                                                              <!-- <a class="dropdown-item product_delete_btn" data-id="#" href="{{ $permission->user_permissions_id}}">
                                                                  <i class="bx bx-trash me-1"></i> Delete
                                                              </a> -->
                                                        </div>
                                                  </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    <tfoot>
                                     <tr>
                                        <th>Assign</th>
                                        <th>Role Type</th>
                                        <th>Permission Type</th>
                                        <th>Can View</th>
                                        <th>Can Add</th>
                                        <th>Can Delete</th>
                                        <th>Can Edit</th>
                                        <th class="text-lg-center">Action</th>
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