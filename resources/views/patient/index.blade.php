    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patients /</span> Search
                  </h4>
                  <div class="card">
                    <div class="card-body">
                      <div class="col-lg-12">
                        <!-- <button class="btn btn-warning">Create Patient</button> -->
                        
                      </div>
                      <br>

                        <h3>Actions</h3>
                          <div class="card">
                            <!-- <div class="card-body"> -->
                              <div align="center" class="col-lg-12">
                                  <table class="table table-responsive" style="color:aqua">
                                    <tr>
                                      <td colspan="2">
                                         <input type="text" id="search_patient" name="search_patient" class="form-control col-lg-12" maxlength="30" placeholder="Member #/OPD #/ Telephone #/ Name ">
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>
                                          <button class="btn btn-primary" name="search_item" id="search_item">Search</button>
                                          <a href="#" class="btn btn-info" id="clear_search">Clear</a>
                                          <a href="{{ route('patients.create') }}" class="btn btn-warning">Create Patient</a>
                                      </td>
                                      <td></td>
                                      
                                    </tr>
                                  </table>
                              </div>
                          <!-- </div> -->
                        </div>
                    </div>
                </div>  
                <br>
                <div class="card">
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
                                  <th>Added Date</th>
                                  <th>Status</th>
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
                                  <th>Added Date</th>
                                  <th>Status</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                      </table>

                    </div>
            </div>
          </div>
</x-app-layout>