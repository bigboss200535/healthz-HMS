    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Diagnosis/</span> List
                  </h4>
                  <div class="app-ecommerce-category">
                  <div class="card">
                    <div class="card-datatable table-responsive">
                      <div style="margin:15px">
                        <a class="btn btn-primary me-sm-3 me-1" href="#">Add New Diagnosis</a>
                      </div>
                      <table class="datatables-category-list table border-top" id="product_list">
                        <thead>
                          <tr>
                            <th>Sn</th>
                            <th>Diagnosis</th>
                            <th>Class</th>
                            <th>ICD-10</th>
                            <th class="text-nowrap text-sm-end">GDRG &nbsp;</th>
                            <th>NHIS Cover</th>
                            <th>Status</th>
                            <th class="text-lg-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                           @php
                              $counter = 1;
                            @endphp
                            @foreach($diagnosis as $diagnoses)
                            <tr>
                                  <td>{{ $counter++ }}</td>
                                  <td>{{ $diagnoses->diagnosis }}</td>
                                  <td>{{ $diagnoses->class }}</td>
                                  <td>{{ $diagnoses->icd_10 }}</td>
                                  <td>{{$diagnoses->gdrg_code}}</td>
                                  <td class="text-nowrap text-sm-end" style="padding-right: 10px;">
                                    @if($diagnoses->is_nhis === 'Yes')
                                    <span class="badge bg-label-info me-1">Yes</span>
                                    @elseif ($diagnoses->is_nhis === 'No')
                                    <span class="badge bg-label-danger me-1">No</span>
                                    @endif
                                  </td>
                                  <td class="text-nowrap text-sm-end" align="left">
                                    @if($diagnoses->status === 'Active')
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
                                                        <i class="bx bx-edit-alt me-1"></i> More
                                                      </a>
                                                      <a class="dropdown-item product_delete_btn" data-id="{{ $diagnoses->diagnosis_id}}" href="#">
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
                            <th>Diagnosis</th>
                            <th>Class</th>
                            <th>ICD-10</th>
                            <th>GDRG &nbsp;</th>
                            <th>NHIS Cover</th>
                            <th>Status</th>
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