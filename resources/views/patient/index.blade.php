<x-app-layout>
               <div class="container-xxl flex-grow-1 container-p-y">    
                  <h4 class="py-3 mb-4">
                    <span class="text-muted fw-light">Patients /</span> Search Patient
                  </h4>

                  <div class="card">
                    <div class="card-body">
                            <!-- <button class="btn btn-danger mb-3" type="button">
                                <i class="bx bx-filter"></i> Advanced Search
                            </button> -->
                                    <br>
                        <!-- <h3>Patient Search</h3> -->
                          <div class="card" style="border-color: black; border-width:2px">
                                  <div align="center" class="col-lg-12"> <div class="mb-3">
                                    <!-- <button class="btn btn-dark mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
                                        <i class="bx bx-filter"></i> Advanced Search
                                    </button> -->
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
                               
                                 <!-- Search Buttons -->
                                  <table class="table table-responsive" style="color:aqua">
                                    <tr align="center">
                                      <td>
                                         <button class="btn btn-primary" name="search_item" id="search_item"><i class="bx bx-search"></i> Search</button>
                                          <button class="btn btn-info" id="clear_search"><i class="bx bx-reset"></i> Clear</button>
                                          <a href="{{ route('patients.create') }}" class="btn btn-dark"> <i class="bx bx-plus"></i> Create New Patient</a>
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
                      <h4 class="mb-1 mt-3">Patient Search Results</h4>
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
                                  <th>Birth Date</th>
                                  <th>Age</th>
                                  <th>Telephone</th>
                                  <th>Added Date</th>
                                  <th>Action</th>
                              </tr>
                          </tfoot>
                      </table>
                    </div>
            </div>
          </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Clear search form
    document.getElementById('clear_search').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('search_patient').value = '';
        document.getElementById('patient_search_result').style.display = 'none';
    });

    // Handle search
    document.getElementById('search_item').addEventListener('click', function() {
        // Get search value
        const searchValue = document.getElementById('search_patient').value.trim();
        
        if (searchValue === '') {
            toastr.warning('Please enter a search term');
            return;
        }
        
        // Show loading state
        const searchButton = document.getElementById('search_item');
        const originalButtonText = searchButton.innerHTML;
        searchButton.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Searching...';
        searchButton.disabled = true;
        
        // Make AJAX request to search patients
        $.ajax({
           
            url: '{{ route("patient.fetch") }}',
            type: 'GET',
            data: {
                search_type: 'basic',
                search_value: searchValue
            },
            dataType: 'json',
            success: function(response) {
                // Reset button state
                searchButton.innerHTML = originalButtonText;
                searchButton.disabled = false;
                
                // Show results container
                const resultsContainer = document.getElementById('patient_search_result');
                if (resultsContainer) {
                    resultsContainer.style.display = 'block';
                }
                
                // Clear existing table data
                const tableBody = document.querySelector('#patient_search_list tbody');
                if (!tableBody) {
                    console.error('Table body not found');
                    return;
                }
                tableBody.innerHTML = '';
                
                // Check if we have results - handle both array and object formats
                let patientData = [];
                
                if (Array.isArray(response)) {
                    patientData = response;
                } else if (response && response.data && Array.isArray(response.data)) {
                    patientData = response.data;
                } else if (response && typeof response === 'object' && response !== null) {
                    // Single object result
                    patientData = [response];
                }
                
                if (patientData.length > 0) {
                    // Populate table with results
                    patientData.forEach((patient, index) => {
                        const row = document.createElement('tr');
                        
                        // Format date of birth if it exists
                        let formatted_dob = 'N/A';
                        let age = 'N/A';
                        
                        if (patient.birth_date) {
                            try {
                                const dob = new Date(patient.birth_date);
                                if (!isNaN(dob.getTime())) {
                                    formatted_dob = dob.toLocaleDateString();
                                    
                                    // Calculate age
                                    const today = new Date();
                                    age = today.getFullYear() - dob.getFullYear();
                                    const monthDiff = today.getMonth() - dob.getMonth();
                                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                                        age--;
                                    }
                                }
                            } catch (e) {
                                // console.error("Error formatting birth date:", e);
                            }
                        }
                        
                        // Format created date if it exists
                        let formatted_added_date = 'N/A';
                        if (patient.added_date) {
                            try {
                                const createdDate = new Date(patient.added_date);
                                if (!isNaN(createdDate.getTime())) {
                                    formatted_added_date = createdDate.toLocaleDateString();
                                }
                            } catch (e) {
                                // console.error("Error formatting added date:", e);
                                formatted_added_date = patient.added_date;
                            }
                        } else if (patient.registration_date) {
                            try {
                                const regDate = new Date(patient.registration_date);
                                if (!isNaN(regDate.getTime())) {
                                    formatted_added_date = regDate.toLocaleDateString();
                                }
                            } catch (e) {
                                // console.error("Error formatting registration date:", e);
                                formatted_added_date = patient.registration_date;
                            }
                        }
                        
                        // Determine gender display
                        let genderDisplay = '';
                        if (patient.gender_id === '2' || patient.gender_id === 2) {
                            genderDisplay = 'MALE';
                        } else if (patient.gender_id === '3' || patient.gender_id === 3) {
                            genderDisplay = 'FEMALE';
                        } else if (patient.gender) {
                            genderDisplay = patient.gender.toUpperCase();
                        }
                        
                        // Build patient name
                        let full_name = patient.fullname || 
                                      `${patient.lastname || ''} ${patient.firstname || ''} ${patient.middlename || ''}`.trim();
                        
                        // Build row HTML
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${full_name}</td>
                            <td>${patient.opd_number || 'N/A'}</td>
                            <td>${genderDisplay}</td>
                            <td>${formatted_dob}</td>
                            <td>${age}</td>
                            <td>${patient.telephone || 'N/A'}</td>
                            <td>${formatted_added_date}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" data-bs-toggle='modal' data-bs-target='#add_attendance' 
                                                data-patient-id='${ patient.patient_id }' 
                                                data-attendance-id='${ patient.attendace_id ?? ''}'
                                                data-opdnumber-id='${patient.opd_number }'>
                                            <i class="bx bx-plus me-1"></i> New Attendance
                                        </a>
                                        <a class="dropdown-item" href="{{ url('#') }}/${patient.patient_id}">
                                            <i class="bx bx-wallet-alt me-1"></i> Manage Sponsors
                                        </a>
                                        <a class="dropdown-item" href="{{ url('patients') }}/${patient.patient_id}">
                                            <i class="bx bx-folder-open me-1"></i> View Details
                                        </a>
                                    </div>
                                </div>
                            </td>
                        `;
                        
                        tableBody.appendChild(row);
                    });
                } else {
                    // No results found
                    const row = document.createElement('tr');
                    row.innerHTML = '<td colspan="9" class="text-center">No patients found matching your search criteria</td>';
                    tableBody.appendChild(row);
                }
            },
            error: function(xhr, status, error) {
                // Reset button state
                searchButton.innerHTML = originalButtonText;
                searchButton.disabled = false;
                
                // Show error message
                console.error("AJAX Error:", xhr.responseText);
                toastr.error('An error occurred while searching. Please try again.');
            }
        });
    });
});
</script>
</x-app-layout>