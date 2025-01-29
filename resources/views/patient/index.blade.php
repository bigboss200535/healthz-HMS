    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patients /</span> Search
                  </h4>
                  <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                      <div class="d-flex flex-column justify-content-center">
                      </div>
                      <div class="d-flex align-content-center flex-wrap gap-3">
                        <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdoal_form" >Search Patient</button> -->
                        <a href="{{ route('patients.create') }}" class="btn btn-warning">Create Patient</a>
                        <a href="#" class="btn btn-primary">Patient Sponsors</a>
                        <a href="#" class="btn btn-success">Advance Search</a>
                      </div>
                    </div>
                  <div class="card">
                    <div class="card-body">
                        <h3>Patient Search</h3>
                          <div class="card">
                            <!-- <div class="card-body"> -->
                              <div align="center" class="col-lg-12">
                                  <table class="table table-responsive" style="color:aqua">
                                    <tr>
                                      <td colspan="2">
                                        <label for="search_patient"> Member #/OPD #/ Telephone # </label>
                                        <i class="bx bx-scan"></i>
                                          <input type="text" id="search_patient" name="search_patient" class="form-control col-lg-12" maxlength="30" min="3" placeholder="Member# /OPD#/ Telephone #" autocomplete="off">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <button class="btn btn-primary" name="search_item" id="search_item">Search</button>
                                             <a href="#" class="btn btn-info" id="clear_search">Clear</a>
                                          <!-- <a href="{{ route('patients.create') }}" class="btn btn-warning">Create Patient</a> -->
                                      </td>
                                      <td>

                                      </td>
                                    </tr>
                                  </table>
                              </div>
                          <!-- </div> -->
                        </div>
                    </div>
                </div>  
                <br>
                <div class="card" id="patient_search_result" style="display: none;">
                    <div class="card-datatable table-responsive">
                      <div class="col" style="padding-left:20px;"> 
                      <h4 class="mb-1 mt-3">Patient Search data</h4>
                      </div>
                      <table class="datatables-customers table border-top" id="patient_search_list">
                          <thead>
                              <tr>
                                  <th>S/N</th>
                                  <th>Name</th>
                                  <th>OPD #</th>
                                  <th>Gender</th>
                                  <th>Age</th>
                                  <th>Telephone</th>
                                  <th>Birth Date</th>
                                  <th>Added Date</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                              <!-- Dynamic rows will be inserted here by the script -->
                          </tbody>
                          <tfoot>
                              <tr>
                                  <th>S/N</th>
                                  <th>Name</th>
                                  <th>OPD #</th>
                                  <th>Gender</th>
                                  <th>Age</th>
                                  <th>Telephone</th>
                                  <th>Birth Date</th>
                                  <th>Added Date</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                      </table>
                    </div>
            </div>
          </div>
</x-app-layout>