    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Setup/</span> Facility Setup
                  </h4>
                  <div class="row">
                      <div class="col-12 col-lg-12">
                          <div class="card mb-4">
                            <div class="card-header">
                              <h5 class="card-tile mb-0"><b>Health Facility Setup</b></h5>
                            </div>
                            <div class="card-body">
                              <form id="clinic_form" enctype="multipart/form-data" method="post">
                              @csrf
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="facility_name">Facility Name <a style="color: red;">*</a></label>
                                  <input type="text" class="form-control" value="{{ $facility_details->facility_name }}" id="facility_name" name="facility_name" placeholder="Facility Name" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="slogan">Slogan / Motto</label>
                                  <input type="text" class="form-control" value="{{ $facility_details->slogan }}" id="slogan" name="slogan" placeholder="Facility Slogan" autocomplete="off">
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="telephone">Telephone</label>
                                  <input type="text" class="form-control" id="telephone" name="telephone" value="{{ $facility_details->telephone }}">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="email">Email </label>
                                  <input type="text" class="form-control" id="email" name="email" value="{{ $facility_details->email }}">
                                </div>
                              </div>  
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="website">Website </label>
                                  <input type="text" class="form-control" id="website" name="website" value="{{ $facility_details->website }}">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="allow_api">Allow API </label>
                                  <select name="allow_api" id="allow_api" class="form-control">
                                    <option disabled selected>-Select-</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                  </select>
                                </div>
                              </div>  
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="facility_type">Facility Type</label>
                                    <select name="facility_type" id="facility_type" class="form-control">
                                        <option disabled selected>-Select-</option>
                                        @foreach($facility_type as $facility_types)                                        
                                          <option value="{{ $facility_types->h_f_id}}">{{ $facility_types->levels }}</option>
                                         @endforeach 
                                    </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="nhis_accreditted">NHIS Accredited </label>
                                  <select name="nhis_accreditted" id="nhis_accreditted" class="form-control">
                                        <option disabled selected>-Select-</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="claim_code">Claims Code Type</label>
                                    <select name="claim_code" id="claim_code" class="form-control">
                                      <!-- <option disabled selected></option> -->
                                      <option value="Automatic">Automatic</option>
                                      <option value="Manual">Manual</option>
                                    </select>
                                </div>
                                <div class="col">
                                  <label class="form-label" for="status">Status </label>
                                  <select name="status" id="status" class="form-control">
                                    <option disabled selected></option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                  </select>
                                </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col">
                                  <label class="form-label" for="u_block">CCC Api Key </label>
                                    <input type="text" class="form-control" value="{{ $facility_details->nhia_key  }}">
                                </div>
                                <div class="col">
                                  <label class="form-label" for="status">CCC Api Secret </label>
                                    <input type="text" class="form-control" value="{{ $facility_details->nhia_secret }}">
                                </div>
                              </div>    
                                  <div class="d-flex align-content-center flex-wrap gap-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-label-secondary">clear</button>
                                </div>
                            </div>
                          </div>
                        </div>
                        
                    </div>
             </div> 
          </div>
    </x-app-layout>