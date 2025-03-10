    <x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patients /</span> Search
                  </h4>

                  <div class="card">
                    <div class="card-body">
                        <!-- <h3>Patient Search</h3> -->
                          <div class="card" style="border-color: black; border-width:2px">
                            <!-- <div class="card-body"> -->
                                  <div align="center" class="col-lg-12"> <div class="mb-3">
                                    <button class="btn btn-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
                                        <i class="bx bx-filter"></i> Advanced Search
                                    </button>
                                  </div>
                                  <!-- Basic Search -->
                                <div class="basic-search mb-3">
                                    <table class="table table-responsive">
                                        <tr>
                                            <td colspan="2">
                                                <label for="search_patient">Member #/OPD #/Telephone #</label>
                                                <div class="input-group">
                                                    <input type="text" id="search_patient" name="search_patient" class="form-control" maxlength="30" minlength="3" placeholder="Search Data" autocomplete="off">
                                                    <span class="input-group-text">
                                                        <i class="bx bx-scan"></i>
                                                    </span>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- Advanced Search -->
                                <div class="collapse" id="advancedSearch">
                                    <div class="card card-body bg-light mb-3">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="patient_name">Firstname</label>
                                                <input type="text" class="form-control" id="patient_name" name="patient_name">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="date_of_birth">Othername</label>
                                                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gender">Gender</label>
                                                <select class="form-select" id="gender" name="gender">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="patient_name">Birth Date</label>
                                                <input type="text" class="form-control" id="patient_name" name="patient_name">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="date_of_birth">Address</label>
                                                <input type="text" class="form-control" id="date_of_birth" name="date_of_birth">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gender">Sponsor</label>
                                                <select class="form-select" id="gender" name="gender">
                                                    <option disabled selected>Select Sponsor</option>
                                                    <option value="M">Male</option>
                                                    <option value="F">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- Search Buttons -->
                                  <table class="table table-responsive" style="color:aqua">
                                    <tr>
                                      <td>
                                         <button class="btn btn-primary" name="search_item" id="search_item"><i class="bx bx-search"></i> Search</button>
                                          <button class="btn btn-info" id="clear_search"><i class="bx bx-reset"></i> Clear</button>
                                          <a href="{{ route('patients.create') }}" class="btn btn-dark"> <i class="bx bx-plus"></i> Create Patient</a>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Clear search form
    document.getElementById('clear_search').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('search_patient').value = '';
        document.getElementById('patient_name').value = '';
        document.getElementById('date_of_birth').value = '';
        document.getElementById('gender').value = '';
        document.getElementById('insurance_number').value = '';
    });

    // Handle search
    document.getElementById('search_item').addEventListener('click', function() {
        // Collect all search parameters
        const searchData = {
            basic_search: document.getElementById('search_patient').value,
            patient_name: document.getElementById('patient_name').value,
            date_of_birth: document.getElementById('date_of_birth').value,
            gender: document.getElementById('gender').value,
            insurance_number: document.getElementById('insurance_number').value
        };

        // TODO: Implement your search logic here
        console.log('Search parameters:', searchData);
    });
});
</script>