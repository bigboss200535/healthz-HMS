// *************************** GENERATE OPD NUMBER *****************************/

$(document).on('change', '#folder_clinic', function() {
  
    var opd_type = $('#opd_type').val();
    var folder_clinic = $('#folder_clinic').val();
  
    $('#opd_number').val('');
  
    $.ajax({
        url: '/patient/new-opd-number/'+folder_clinic,
        type: 'GET',
        data: {opd_type:opd_type, folder_clinic:folder_clinic},
        success: function(response) {
            if (response.code===201) {
                // $('#opd_number').prop('disabled', true);
                $('#opd_number').val(response.result);
            } else if (response.code === 200) {
                // $('#opd_number').prop('disabled', false);
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Error Generating OPD data! Try again.'); // Display error message if AJAX request fails
        }
    });




// ***************************************** Sponsor change ***********************************

    document.addEventListener('DOMContentLoaded', function () {
        const sponsorTypeSelect = document.getElementById('sponsor_type_id');
        const sponsorshipDetails = document.querySelectorAll('.sponsorship_details_settings');
    
        // Hide sponsorship details if "Cash" is selected
        function toggleSponsorshipDetails() {
            if (sponsorTypeSelect.value === 'P001') { // Assuming "1001" is for "Cash"
                sponsorshipDetails.forEach(detail => detail.style.display = 'none');
            } else {
                sponsorshipDetails.forEach(detail => detail.style.display = 'block');
            }
        }
        // Initialize based on the default selection
        toggleSponsorshipDetails();
    
        // Event listener for dropdown change
        sponsorTypeSelect.addEventListener('change', toggleSponsorshipDetails);
    });



// ************************** GET ALL PATIENT and REQUESTS?**********************************

const patient_Id = $('#patient_id').val();

if (!patient_Id) {
    console.error('Patient id is missing.');
    return;
}

// Reusable function to initialize DataTables with additional safety check
    function initializeDataTable(table_id, columns) {
        // Extra check - only initialize if the table exists
        if (!$(table_id).length) {
            console.warn(`Table ${table_id} not found`);
            return null;
        }
        
        // Destroy existing instance if it exists
        if ($.fn.DataTable.isDataTable(table_id)) {
            $(table_id).DataTable().destroy();
            console.log(`Destroyed existing DataTable instance for ${table_id}`);
        }
        
        return $(table_id).DataTable({
            paging: true,
            pageLength: 5,
            searching: true,
            ordering: true,
            responsive: true,
            autoWidth: false,
            columns: columns
        });
    }
    
    // Helper function to format dates
    function formatDate(dateString) {
        if (!dateString) return 'N/A';
        const date = new Date(dateString);
        return date.toLocaleDateString();
    }

    // Helper function to fetch data from API
    function fetchData(url) {
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                return [];
            });
    }
// Initialize DataTables
const sponsorsTable = initializeDataTable('#patient_sponsor', [
    { data: 'sponsor_name' },
    { data: 'member_no' },
    { data: 'start_date' },
    { data: 'end_date' },
    { data: 'status' },
    { data: 'priority' },
    { data: 'actions', orderable: false }
]);

const attendanceTable = initializeDataTable('#attendance_details', [
    { data: 'attendance_id' },
    { data: 'attendance_date' },
    { data: 'full_age' },
    { data: 'pat_clinic' },
    { data: 'sponsor' },
    { data: 'status' },
    { 
        data: 'service_issued',
        render: function (data, type, row) {
            if (data === '0') {
                return '<span class="badge bg-label-danger me-1">Unassigned</span>';
            } else if (data === '1') {
                return '<span class="badge bg-label-success me-1">Assigned</span>';
            }
            return data; // Fallback for unexpected status values
        }
    },
    { data: 'actions', orderable: false }
]);

const currentattendanceTable = initializeDataTable('#current_attendance', [
    { data: 'attendance_id' },
    { data: 'attendance_date' },
    { data: 'full_age' },
    { data: 'pat_clinic' },
    { data: 'sponsor' },
    { data: 'attendance_type' },
    { 
        data: 'service_issued',
        render: function (data, type, row) {
            if (data === '0') 
                {
                return '<span class="badge bg-label-danger me-1">Unassigned</span>';
            } else if (data === '1') 
                {
                return '<span class="badge bg-label-success me-1">Assigned</span>';
            }
            return data; // Fallback for unexpected status values
        }
    },
    { data: 'actions', orderable: false }
]);

// Fetch and refresh data
function fetchAndRefreshData() {
    Promise.all([
        fetchData(`/patient/patient-sponsors/${patient_Id}`),
        fetchData(`/patient/single-attendance/${patient_Id}`),
        fetchData(`/patient/current-attendance/${patient_Id}`)
    ])
    .then(([sponsorsResponse, attendanceResponse, currentResponse]) => {
        // Clear and re-populate sponsors table
        sponsorsTable.clear().rows.add(sponsorsResponse.map(patient => ({
            sponsor_name: `<a href="/patients/${patient_Id}">${patient.sponsor_name}</a>`,
            member_no: patient.member_no,
            start_date: formatDate(patient.start_date),
            end_date: formatDate(patient.end_date),
            status: patient.status ? 'Active' : 'Inactive',
            priority: patient.priority,
            actions: `
                <div class="dropdown" align="center">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/patients/${patient_Id}">
                            <i class="bx bx-detail me-1"></i> Edit
                        </a>
                        <a class="dropdown-item" href="/patients/${patient_Id}">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            `
        }))).draw();

        // Clear and re-populate attendance table
        attendanceTable.clear().rows.add(attendanceResponse.map(attendance => ({
            attendance_id: `<a href="${attendance.attendance_id}">${attendance.attendance_id}</a>`,
            attendance_date: formatDate(attendance.attendance_date),
            full_age: attendance.full_age || 'N/A',
            pat_clinic: attendance.pat_clinic,
            sponsor: attendance.sponsor,
            status: attendance.status ? 'Active' : 'Inactive',
            service_issued: attendance.service_issued || 'N/A',
            actions: `
                <div class="dropdown" align="center">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/consultation/opd-consultation/${attendance.attendance_id}">
                            <i class="bx bx-detail me-1"></i> Consult
                        </a>
                        <a class="dropdown-item" href="/patients/${patient_Id}">
                            <i class="bx bx-detail me-1"></i> View
                        </a>
                        <a class="dropdown-item" href="/patients/${patient_Id}">
                            <i class="bx bx-trash me-1"></i> E-Folder
                        </a>
                    </div>
                </div>
            `
        }))).draw();

        // Clear and re-populate current attendance table
        currentattendanceTable.clear().rows.add(currentResponse.map(current_attendance => ({
            attendance_id: `<a href="${current_attendance.attendance_id}">${current_attendance.attendance_id}</a>`,
            attendance_date: formatDate(current_attendance.attendance_date),
            full_age: current_attendance.full_age || 'N/A',
            pat_clinic: current_attendance.pat_clinic,
            sponsor: current_attendance.sponsor,
            attendance_type: current_attendance.attendance_type || 'N/A',
            service_issued: current_attendance.service_issued || 'N/A',
            actions: `
                <div class="dropdown" align="center">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/consultation/opd-consultation/${current_attendance.attendance_id}">
                            <i class="bx bx-detail me-1"></i> Consult
                        </a>
                        <a class="dropdown-item" href="/patients/${patient_Id}">
                            <i class="bx bx-play me-1"></i> Hold
                        </a>
                        <a class="dropdown-item" href="/patients/${patient_Id}">
                            <i class="bx bx-trash me-1"></i> Delete
                        </a>
                    </div>
                </div>
            `
        }))).draw();
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}
// Initial data fetch
fetchAndRefreshData();

// Optionally, refresh data periodically or on user action
// setInterval(fetchAndRefreshData, 10000); // Refresh every 10 seconds







  });

  

  