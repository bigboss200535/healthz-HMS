    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Product/</span> List
                  </h4>
                  <div class="row g-4 mb-4">
                    <div class="col-sm-6 col-xl-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                              <span></span>
                              <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ number_format($total_all) }}</h4>
                                <!-- <small class="text-success">(+29%)</small> -->
                              </div>
                              <p class="mb-0">All Products </p>
                            </div>
                            <div class="avatar">
                              <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user bx-sm"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                              <span></span>
                              <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ number_format($total_drugs) }}</h4>
                                <!-- <small class="text-success">(+18%)</small> -->
                              </div>
                              <p class="mb-0">Total Drugs</p>
                            </div>
                            <div class="avatar">
                              <span class="avatar-initial rounded bg-label-danger">
                                <i class="bx bx-user-check bx-sm"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                              <span></span>
                              <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ number_format($total_consumable) }}</h4>
                                <!-- <small class="text-danger">(-14%)</small> -->
                              </div>
                              <p class="mb-0">Total Consumables</p>
                            </div>
                            <div class="avatar">
                              <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-group bx-sm"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex align-items-start justify-content-between">
                            <div class="content-left">
                              <span> </span>
                              <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ number_format( $total_others) }}</h4>
                                <!-- <small class="text-success">(+42%)</small> -->
                              </div>
                              <p class="mb-0">Others </p>
                            </div>
                            <div class="avatar">
                              <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bx-user-voice bx-sm"></i>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="app-ecommerce-category">
                  <div class="row">
                      <div class="col-12 col-lg-5">
                          <div class="card mb-4">
                            <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Product Setup</b></h5>
                            </div>
                            <div class="card-body">
                              <form id="clinic_form" enctype="multipart/form-data" method="post">
                              @csrf
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_user_name">Product Name <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_user_name" name="u_user_name" placeholder="Product Name" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="first_name">Product Class <a style="color: red;">*</a></label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                     
                                  </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="other_name">Product Route</label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                     
                                  </select>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_pass_word">Presentation <a style="color: red;">*</a></label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                        @foreach($presentation as $present)                                        
                                            <option value="{{ $present->pp_id}}">{{ $present->presentation }}</option>
                                        @endforeach
                                  </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="confirm_pass">Store <a style="color: red;">*</a></label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                        @foreach($store as $stores)                                        
                                            <option value="{{ $stores->store_id}}">{{ $stores->store }}</option>
                                        @endforeach
                                  </select>
                                </div>
                              </div>   
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="gender">Expirable <a style="color: red;">*</a></label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                     
                                  </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="u_email">Stockable </label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                     
                                  </select>
                                </div>
                              </div>   
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_telephone">Unit Cost <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_telephone" name="u_telephone" placeholder="0.00">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="user_role">Enable NHIS <a style="color: red;">*</a></label>
                                  <select name="gender" id="gender" class="form-control">
                                    <option disabled selected>-Select-</option>
                                     
                                  </select>
                                </div>
                              </div>  
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_telephone">Least Prescripe Qty <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_telephone" name="u_telephone" placeholder="1">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="user_role">Available Unit Qty <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_telephone" name="u_telephone" placeholder="">
                                </div>
                              </div>  
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_telephone">G-DRG <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_telephone" name="u_telephone" placeholder="1">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="user_role">Manufacturer <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" id="u_telephone" name="u_telephone" placeholder="">
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
                              <h5 class="card-tile mb-0"><b>Products List</b></h5>
                            </div>
                            <div class="card-body">
                                <table class="datatables-category-list table border-top" id="product_list">
                                    <thead>
                                      <tr>
                                        <th>Sn</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <!-- <th>Block</th> -->
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th class="text-lg-center"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                          $counter = 1;
                                        @endphp
                                        @foreach($item as $product)
                                        <tr>
                                          <td>{{ $counter++ }}</td>
                                          <td>{{ $product->product_name }}</td>
                                          <td>{{ $product->product_type }}</td>
                                          <td><span class="badge bg-label-primary me-1"></span></td>
                                          <td class="text-nowrap text-sm-end" align="left">
                                               @if($product->status === 'Active')
                                                <span class="badge bg-label-info me-1">Active</span>
                                                @elseif ($product->status === 'Inactive')
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
                                                              <a class="dropdown-item" href="">
                                                                <i class="bx bx-lock-alt me-1"></i> Prices
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
                                        <th>Name</th>
                                        <th>Username</th>
                                        <!-- <th>Block</th> -->
                                        <th>Role</th>
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