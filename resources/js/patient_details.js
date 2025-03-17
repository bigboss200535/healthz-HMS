//  ********************** PATIENT SAVE SCRIPT ************************
$('#patient_info').on('submit', function (e) {
    e.preventDefault();

    // Collect patient form data using a single object to minimize DOM queries
    const patient_save = {
        sponsor_type_id: $('#sponsor_type_id').val(),
        pat_id: $('#pat_id').val(),
        title: $('#title').val(),
        firstname: $('#firstname').val().trim(),
        middlename: $('#middlename').val().trim(),
        lastname: $('#lastname').val().trim(),
        birth_date: $('#birth_date').val(),
        gender_id: $('#gender_id').val(),
        occupation: $('#occupation').val(),
        education: $('#education').val(),
        religion: $('#religion').val(),
        nationality: $('#nationality').val(),
        ghana_card: $('#ghana_card').val(),
        telephone: $('#telephone').val(),
        work_telephone: $('#work_telephone').val(),
        email: $('#email').val(),
        address: $('#address').val(),
        town: $('#town').val(),
        region: $('#region').val(),
        contact_person: $('#contact_person').val(),
        contact_telephone: $('#contact_telephone').val(),
        contact_relationship: $('#contact_relationship').val(),
        opd_type: $('#opd_type').val(),
        folder_clinic: $('#folder_clinic').val(),
        opd_number: $('#opd_number').val(),
        sponsor_id: $('#sponsor_id').val(),
        member_no: $('#member_no').val(),
        dependant: $('#dependant').val(),
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        card_status: $('#card_status').val(),
    };

    // Client-side validation
    if (!patient_save.title || patient_save.title === "0") {
        toastr.warning('Please select a title');
        $('#title').focus();
        return;
    }

    if (!patient_save.firstname) {
        toastr.warning('Firstname cannot be empty');
        $('#firstname').focus();
        return;
    }

    if (patient_save.firstname.length < 3) {
        toastr.warning('First name must be at least 3 characters long');
        $('#firstname').focus();
        return;
    }

    if (!patient_save.lastname) {
        toastr.warning('Lastname cannot be empty');
        $('#lastname').focus();
        return;
    }

    if (patient_save.lastname.length < 3) {
        toastr.warning('Lastname must be at least 3 characters long');
        $('#lastname').focus();
        return;
    }

    if (patient_save.opd_number.length < 3) {
        toastr.warning('Record Number is invalid');
        $('#opd_number').focus();
        return;
    }

    if (!patient_save.birth_date) {
        toastr.warning('Birth Date must be entered');
        $('#birth_date').focus();
        return;
    }

    if (!patient_save.gender_id || patient_save.gender_id === "0") {
        toastr.warning('Please select gender');
        $('#gender_id').focus();
        return;
    }

    if (!patient_save.sponsor_type_id || patient_save.sponsor_type_id === "0") {
        toastr.warning('Sponsor type must be selected');
        $('#sponsor_type_id').focus();
        return;
    } else if (!patient_save.sponsor_id || !patient_save.member_no || !patient_save.start_date || !patient_save.end_date) {
        toastr.warning('Sponsor ID, Member No, Start and End Date must be filled for selected sponsor');
        return;
    }

    // Determine URL and method based on pat_id
    const url = patient_save.pat_id ? `/patients/${patient_save.pat_id}` : '/patients';
    const method = patient_save.pat_id ? 'PUT' : 'POST';

    // AJAX request
    $.ajax({
        url: url,
        type: method,
        data: $(this).serialize(),
        success: function (response) {
            if (response.code === 201) {
                toastr.success(response.message);
                $('#patient_info')[0].reset();
                $('#pat_id').val(''); // Clear pat_id for new entries
            } else if (response.code === 200) {
                toastr.warning('Patient data is already available in the system!');
            } else {
                toastr.error('Error saving data! Try again.');
            }
        },
        error: function (xhr, status, error) {
            toastr.error('Error saving data! Try again.');
        }
    });
});
// *********************** PATIENT SAVE SCRIPT ************************

// ************************* PATIENT SEARCH SCRIPT ******************

// Debounce function to limit the rate of AJAX requests
function debounce(func, wait) {
    let timeout;
    return function(...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), wait);
    };
}

// Age calculation function
function calculateAge(birthDate) {
    const birth = new Date(birthDate);
    const today = new Date();
    let age = today.getFullYear() - birth.getFullYear();
    const month = today.getMonth();
    const day = today.getDate();
    if (month < birth.getMonth() || (month === birth.getMonth() && day < birth.getDate())) {
        age--;
    }
    return age;
}

function renderTableRows(table, data) {// Function to render the table rows
    table.clear();
    if (data.length > 0) {
        data.forEach((patient, index) => {
            const age = calculateAge(patient.birth_date);
            const row = [
                index + 1,
                `<a href="/patients/${patient.patient_id}">${patient.fullname}</a>`,
                patient.opd_number,
                patient.gender_id === '3' ? 'MALE' : 'FEMALE',
                age,
                patient.telephone,
                new Date(patient.birth_date).toLocaleDateString('en-GB'),
                new Date(patient.register_date).toLocaleDateString('en-GB'),
                `<div class="dropdown" align="center">
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                        <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/patients/${patient.patient_id}">
                            <i class="bx bx-detail me-1"></i> More
                        </a>
                    </div>
                </div>`
            ];
            table.row.add(row);
        });
        $('#patient_search_result').show(); // Show the table if results are found
    } else {
        toastr.info(' No patient found with the criteria');
        // $('#patient_search_result').hide(); // Show the table even if no results are found
    }
    table.draw();
}

function perform_search(searchTerm) {// Function to handle the AJAX request
    if (searchTerm.trim() !== '') {
        $.ajax({
            url: '/patient/search',
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { search_patient: searchTerm },
            success: function(response) {
                const table = $('#patient_search_list').DataTable();
                renderTableRows(table, response);
            },
            error: function(xhr, status, error) {
                toastr.error('There was an error processing your request');
                $('#patient_search_result').hide(); // Hide the table on error
            }
        });
    } else {
        toastr.error('Please enter a search item');
        $('#patient_search_result').hide(); // Hide the table if search term is empty
    }
}

// Cache the DataTable instance
const patientTable = $('#patient_search_list').DataTable();
// Attach the debounced search function to the input event
$('#search_item').on('click', debounce(function() {
    const search_term = $('#search_patient').val();
            if (search_term.length < 3) {
                toastr.warning('Search field must be at least 3 characters long');
                $('#search_patient').focus();  // Autofocus on the first name field
                return;
            }
    perform_search(search_term);
}, 300));
// ***************************/PATIENT SEARCH SCRIPT ***************************/


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
  });

//   $(":inpumst").inputmask();
  

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
$(document).ready(function () {
    const patient_Id = $('#patient_id').val();

    if (!patient_Id) {
        console.error('Patient id is missing.');
        return;
    }

// Reusable function to initialize DataTables
    function initializeDataTable(table_id, columns) {
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
                            <a class="dropdown-item" href="/patients/${patient_Id}">
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

// Generic function to fetch data
function fetchData(url) {
    return $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json'
    }).catch(error => {
        console.error('Error fetching data from', url, error);
        throw error;
    });
}

// Helper function to format dates
function formatDate(dateString) {
    if (!dateString) return 'N/A';
    const date = new Date(dateString);
    return isNaN(date) ? 'N/A' : date.toLocaleDateString('en-GB');
}