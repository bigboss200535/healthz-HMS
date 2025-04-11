<x-app-layout>
 
<div class="container-xxl flex-grow-1 container-p-y">     
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-12">
            <h4 class="text-muted text-center">-Kingly navigate a menu to display attendace-</h4>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
    <div>
    </div>
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-12">
              <div class="col-xl-12">
              <h3>Patients Attendance</h3>
                <div class="nav-align-top nav-tabs-shadow">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                        <b>Waiting List</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                        <b>Pending Diagnostics</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-messages" aria-controls="navs-top-messages" aria-selected="false">
                        <b>On Hold</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_completed" aria-controls="navs_completed" aria-selected="false">
                        <b>Completed</b>
                      </button>
                    </li>
                    <li class="nav-item">
                      <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_admission" aria-controls="navs_admission" aria-selected="false">
                        <b>Admission List</b>
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                       <h4>Patient Waiting List</h4>
                       
                       <!-- Add date filter controls -->
                       <div class="row mb-3">
                         <div class="col-md-3">
                           <label for="start_date" class="form-label">Start Date</label>
                           <input type="date" id="start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                         </div>
                         <div class="col-md-3">
                           <label for="end_date" class="form-label">End Date</label>
                           <input type="date" id="end_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                         </div>
                         <div class="col-md-2 d-flex align-items-end">
                           <button id="filter_date" class="btn btn-primary"><i class="bx bx-search"></i>Search</button>
                         </div>
                       </div>
                       
                       <table class="table table-responsive" id="app_list">
                           <thead>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </thead>
                           <tbody>
                             <!-- Table body will be populated via AJAX -->
                           </tbody>
                           <tfoot>
                             <tr>
                               <th>SN</th>
                               <th>Attenance Date</th>
                               <th>Patient Name</th>
                               <th>OPD #</th>
                               <th>Gender</th>
                               <th>Patient Age</th>
                               <th>Attendance Sponsor</th>
                               <th>Attendance Clinic</th>
                               <th>Attendance Status </th>
                               <th>Action</th>
                             </tr>
                           </tfoot>
                       </table>
                    <!-- </p> -->
                    </div>
                    <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                      <!-- <p> --> <h4>Pending Diagnostics</h4>
                      <table class="table table-responsive" id="diagnostics_list">
                            <thead>
                              <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                      <!-- </p> -->
                    </div>
                    <div class="tab-pane fade" id="navs-top-messages" role="tabpanel">
                      <h4>Patient On Hold</h4>
                      <table class="table table-responsive" id="patient_list">
                            <thead>
                              <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                      <!-- </p> -->
                    </div>
                 
                  <div class="tab-pane fade" id="navs_completed" role="tabpanel">
                       <h4> Consultation Discharged</h4>
                          <table class="table table-responsive" id="patient_services">
                                <thead>
                                  <tr>
                                    <th>Sn</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Clinic</th>
                                    <th>Sponsor Type #</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Sn</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Age</th>
                                    <th>Clinic</th>
                                    <th>Sponsor Type #</th>
                                    <th>Action</th>
                                  </tr>
                                </tfoot>
                              </table>
                      <!-- </p> -->
                    </div>
                    <div class="tab-pane fade" id="navs_admission" role="tabpanel">
                    <h4> Admission List</h4>
                      <table class="table table-responsive" id="patient_sponsor">
                            <thead>
                              <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Sn</th>
                                <th>Date</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Age</th>
                                <th>Ward</th>
                                <th>Bed #</th>
                                <th>Admit Date</th>
                                <th>Action</th>
                              </tr>
                            </tfoot>
                          </table>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>        

<!-- Add JavaScript for date filtering -->
<script>
$(document).ready(function() {
    // Initialize DataTables
    const appListTable = $('#app_list').DataTable({
        processing: true,
        serverSide: false,
        searching: true,
        paging: true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    });
    
    $('#diagnostics_list').DataTable();
    $('#patient_list').DataTable();
    $('#patient_services').DataTable();
    $('#patient_sponsor').DataTable();
    
    // Function to load patient data via AJAX
    function loadPatientData() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        
        console.log('Loading data for date range:', start_date, 'to', end_date);
        
        // Clear the table and show loading indicator
        appListTable.clear().draw();
        
        // Make AJAX request
        $.ajax({
            url: '/consultation/opd-waiting',
            type: 'GET',
            data: {
                start_date: start_date,
                end_date: end_date
            },
            dataType: 'json',
            cache: false, // Prevent caching
            beforeSend: function() {
                // Show loading message
                $('#app_list tbody').html('<tr><td colspan="10" class="text-center"><i class="bx bx-loader bx-spin"></i> Loading data...</td></tr>');
                console.log('AJAX request started');
            },
            success: function(response) {
                console.log('AJAX response received:', response);
                
                // Clear the table
                appListTable.clear();
                
                // Add data to the table
                if (response.success && response.data && response.data.length > 0) {
                    $.each(response.data, function(index, patient) {
                        let sponsorBadge = '';
                        if (patient.sponsor_type_id === 'PI03') {
                            sponsorBadge = '<span class="badge bg-label-info me-1">' + patient.sponsor + '</span>';
                        } else if (patient.sponsor_type_id === 'N002') {
                            sponsorBadge = '<span class="badge bg-label-success me-1">' + patient.sponsor + '</span>';
                        } else if (patient.sponsor_type_id === 'P001') {
                            sponsorBadge = '<span class="badge bg-label-warning me-1">' + patient.sponsor + '</span>';
                        } else if (patient.sponsor_type_id === 'PC04') {
                            sponsorBadge = '<span class="badge bg-label-primary me-1">' + patient.sponsor + '</span>';
                        }
                        
                        let statusBadge = '';
                        if (patient.service_issued === '0') {
                            statusBadge = '<span class="badge bg-label-danger me-1">PENDING</span>';
                        } else if (patient.service_issued === '1') {
                            statusBadge = '<span class="badge bg-label-primary me-1">ISSUED</span>';
                        }
                        
                        let actionDropdown = `
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/consultation/opd-consultation/${patient.attendance_id}">
                                        <i class="bx bx-edit-alt me-1"></i> Consult Patient
                                    </a>
                                    <a class="dropdown-item hold_attendance_btn" data-id="${patient.attendance_id}" href="javascript:void(0)">
                                        <i class="bx bx-pause me-1"></i> Hold Attendance
                                    </a>
                                    <a class="dropdown-item attendance_delete_btn" data-id="${patient.attendance_id}" href="#">
                                        <i class="bx bx-trash me-1"></i> Delete Attendance
                                    </a>
                                </div>
                            </div>
                        `;
                        
                        appListTable.row.add([
                            index + 1,
                            patient.formatted_date,
                            patient.fullname,
                            patient.opd_number,
                            patient.gender,
                            patient.full_age,
                            sponsorBadge,
                            patient.pat_clinic,
                            statusBadge,
                            actionDropdown
                        ]).draw(false);
                    });
                } else {
                    // No data found
                    $('#app_list tbody').html('<tr><td colspan="10" class="text-center">No patients found for the selected date range</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                
                // Show error message
                $('#app_list tbody').html('<tr><td colspan="10" class="text-center text-danger">Error loading data. Please try again.</td></tr>');
            }
        });
    }
    
    // Bind click event to the filter button using event delegation
    $(document).on('click', '#filter_date', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log('Filter button clicked');
        loadPatientData();
        return false;
    });
    
    // Set date inputs to URL parameters if they exist
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('start_date')) {
        $('#start_date').val(urlParams.get('start_date'));
    }
    if (urlParams.has('end_date')) {
        $('#end_date').val(urlParams.get('end_date'));
    }
    
    // Load data on page load
    loadPatientData();
    
    // Re-attach event handlers for dynamically created elements
    $(document).on('click', '.hold_attendance_btn', function() {
        const attendanceId = $(this).data('id');
        // Add your hold attendance logic here
        console.log('Hold attendance clicked for ID:', attendanceId);
    });
    
    $(document).on('click', '.attendance_delete_btn', function(e) {
        e.preventDefault();
        const attendanceId = $(this).data('id');
        // Add your delete attendance logic here
        console.log('Delete attendance clicked for ID:', attendanceId);
    });
});
</script>

</x-app-layout>