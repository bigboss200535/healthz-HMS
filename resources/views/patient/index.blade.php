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
                                    <button class="btn btn-dark mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#advancedSearch" aria-expanded="false" aria-controls="advancedSearch">
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
                                                <input type="text" class="form-control" id="firstname" name="firstname">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="date_of_birth">Othername</label>
                                                <input type="text" class="form-control" id="othername" name="othername">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gender">Gender</label>
                                                <select class="form-select" id="gender" name="gender">
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="2">MALE</option>
                                                    <option value="1">FEMALE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="patient_name">Birth Date</label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="date_of_birth">Address</label>
                                                <input type="text" class="form-control" id="address" name="address">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="gender">Sponsor</label>
                                                <!-- <select class="form-select" id="sponsor" name="sponsor"> -->
                                                   
                                                    <select class="form-select" id="sponsor" name="sponsor">
                                                    <option disabled selected>-Select Sponsor-</option>
                                                        @foreach($sponsor_types as $type)
                                                            <option value="{{ $type->sponsor_type_id }}">{{ $type->sponsor_type }}</option>
                                                        @endforeach
                                                    </select>
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
    // Clear search form code remains unchanged
    document.getElementById('clear_search').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('search_patient').value = '';
        
        // Clear advanced search fields if they exist
        if(document.getElementById('firstname')) document.getElementById('firstname').value = '';
        if(document.getElementById('othername')) document.getElementById('othername').value = '';
        if(document.getElementById('gender')) document.getElementById('gender').selectedIndex = 0;
        if(document.getElementById('birthdate')) document.getElementById('birthdate').value = '';
        if(document.getElementById('address')) document.getElementById('address').value = '';
        if(document.getElementById('sponsor')) document.getElementById('sponsor').selectedIndex = 0;
        
        // Hide results if showing
        document.getElementById('patient_search_result').style.display = 'none';
    });

    // Handle search
    document.getElementById('search_item').addEventListener('click', function() {
        // Check if basic search has value
        const basic_search_value = document.getElementById('search_patient').value.trim();
        
        // Initialize search data object
        let searchData = {};
        
        // Determine which search to use (basic or advanced)
        if (basic_search_value !== '') {
            // Use basic search
            searchData = {
                search_type: 'basic',
                search_value: basic_search_value
            };
        } else {
            // Use advanced search if available
            const advancedSearchDiv = document.getElementById('advancedSearch');
            const isAdvancedSearchOpen = advancedSearchDiv.classList.contains('show');
            
            if (isAdvancedSearchOpen) {
                searchData = {
                    search_type: 'advanced',
                    firstname: document.getElementById('firstname').value.trim(),
                    othername: document.getElementById('othername').value.trim(),
                    gender: document.getElementById('gender').value,
                    birthdate: document.getElementById('birthdate').value.trim(),
                    address: document.getElementById('address').value.trim(),
                    sponsor: document.getElementById('sponsor').value
                };
                
                // Check if at least one advanced search field has a value
                const hasAdvancedSearchValue = Object.values(searchData).some((value, index) => 
                    index > 0 && value !== '' && value !== null && value !== undefined);
                
                if (!hasAdvancedSearchValue) {
                    toastr.warning('Please enter at least one search criteria');
                    return;
                }
            } else {
                toastr.warning('Please enter a search term or use advanced search');
                return;
            }
        }
        
        // Show loading state
        const searchButton = document.getElementById('search_item');
        const originalButtonText = searchButton.innerHTML;
        searchButton.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Searching...';
        searchButton.disabled = true;
        
        // Make AJAX request to search patients
        $.ajax({
            url: '{{ route("patient.search") }}',
            type: 'GET',
            data: searchData,
            dataType: 'json',
            success: function(response) {
                // Reset button state
                searchButton.innerHTML = originalButtonText;
                searchButton.disabled = false;
                
                // console.log("Search response:", response); // Debug: Log the response
                
                // Show results container
                document.getElementById('patient_search_result').style.display = 'block';
                
                // Clear existing table data
                const tableBody = document.querySelector('#patient_search_list tbody');
                tableBody.innerHTML = '';
                
                // Check if we have results - handle both array and object formats
                let patientData = [];
                
                if (Array.isArray(response)) {
                    patientData = response;
                } else if (response.data && Array.isArray(response.data)) {
                    patientData = response.data;
                } else if (typeof response === 'object' && response !== null) {
                    // Single object result
                    patientData = [response];
                }
                
                // console.log("Processed patient data:", patientData); // Debug: Log processed data
                
                if (patientData.length > 0) {
                    // Populate table with results
                    patientData.forEach((patient, index) => {
                        const row = document.createElement('tr');
                        
                        // console.log("Processing patient:", patient); // Debug: Log each patient
                        
                        // Format date of birth if it exists
                        let formattedDob = 'N/A';
                        let age = 'N/A';
                        
                        if (patient.birth_date) {
                            try {
                                const dob = new Date(patient.birth_date);
                                formatted_dob = dob.toLocaleDateString();
                                
                                // Calculate age
                                const today = new Date();
                                age = today.getFullYear() - dob.getFullYear();
                                const monthDiff = today.getMonth() - dob.getMonth();
                                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                                    age--;
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
                                formatted_added_date = createdDate.toLocaleDateString();
                            } catch (e) {
                                // console.error("Error formatting added date:", e);
                                formatted_added_date = patient.added_date;
                            }
                        } else if (patient.registration_date) {
                            try {
                                const regDate = new Date(patient.registration_date);
                                formatted_added_date = regDate.toLocaleDateString();
                            } catch (e) {
                                // console.error("Error formatting registration date:", e);
                                formatted_added_date = patient.registration_date;
                            }
                        }
                        
                        // Determine gender display
                        let genderDisplay = 'N/A';
                        if (patient.gender_id === '2' || patient.gender_id === 2) {
                            genderDisplay = 'MALE';
                        } else if (patient.gender_id === '1' || patient.gender_id === 1) {
                            genderDisplay = 'FEMALE';
                        }
                        
                        // Build patient name with proper handling for null/undefined values
                        let full_name = '';
                        
                        // Use fullname field if available
                        if (patient.fullname) {
                            full_name = patient.fullname;
                        } else {
                            const lastname = patient.lastname || '';
                            const firstname = patient.firstname || '';
                            const middlename = patient.middlename || '';
                            full_name = `${lastname} ${firstname} ${middlename}`.trim();
                        }
                        
                        // Build row HTML
                        row.innerHTML = `
                            <td>${index + 1}</td>
                            <td>${full_name}</td>
                            <td>${patient.opd_number || 'N/A'}</td>
                            <td>${genderDisplay}</td>
                            <td>${age}</td>
                            <td>${patient.telephone || 'N/A'}</td>
                            <td>${formatted_dob}</td>
                            <td>${formatted_added_date}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                     <a class="dropdown-item" href="{{ url('patients') }}/${patient.patient_id}">
                                            <i class="bx bx-show me-1"></i> View
                                        </a>
                                        <a class="dropdown-item" href="{{ url('patients/show') }}/${patient.patient_id}/edit">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                       
                                        <a class="dropdown-item" href="{{ url('visits/create') }}/${patient.patient_id}">
                                            <i class="bx bx-plus-circle me-1"></i> New Visit
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