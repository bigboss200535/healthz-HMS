    // PATIENT CREATION SCRIPT
    // ---------------------------------------------------------------------------
    
    $('#patient_info').on('submit', function(e) {
      e.preventDefault();

         // Collect patient form data
          var pat_id = $('#pat_id').val();
          var title = $('#title').val();
          var firstname = $('#firstname').val();
          var middlename = $('#middlename').val();
          var lastname = $('#lastname').val();
          var birth_date = $('#birth_date').val();
          var gender_id = $('#gender_id').val();
          var occupation = $('#occupation').val();
          var education = $('#education').val();
          var religion = $('#religion').val();
          var nationality = $('#nationality').val();
          var ghana_card = $('#ghana_card').val();
          var telephone = $('#telephone').val();
          var work_telephone = $('#work_telephone').val();
          var email = $('#email').val();
          var address = $('#address').val();
          var town = $('#town').val();
          var region = $('#region').val();
          var contact_person = $('#contact_person').val();
          var contact_telephone = $('#contact_telephone').val();
          var contact_relationship = $('#contact_relationship').val();
          var opd_type = $('#opd_type').val();
          var folder_clinic = $('#folder_clinic').val();
          var opd_number = $('#opd_number').val();
          var sponsor_type_id = $('#sponsor_type_id').val();
          var sponsor_id = $('#sponsor_id').val();
          var member_no = $('#member_no').val();
          var dependant = $('#dependant').val();
          var start_date = $('#start_date').val();
          var end_date = $('#end_date').val();
          var card_status = $('#card_status').val();

          var url = pat_id ? '/patients/' + pat_id : '/patients';
          var method = pat_id ? 'PUT' : 'POST';

      // Client-side validation

      if (!title || title === "0") {  // Check if title is selected or the default "0"
        toastr.warning('Please select a title'); 
        return;
      }
      // Remove red focus class from #title once the user fixes it
    if(firstname.length < 3) {
          toastr.warning('First name must be at least 3 characters long');
        return;
    }

    if (!firstname.trim()) {
        toastr.warning('Firstname cannot be empty');
        $('#firstname').focus();  // Autofocus on the first name field
        return;
    }

    if (!lastname.trim()) {
        toastr.warning('Lastname cannot be empty');
        $('#lastname').focus();  // Autofocus on the first name field
        return;
    }

    if (lastname.length < 3) {
        toastr.warning('Lastname is must be at least 3 characters long');
        return;
    }

    if(middlename.length < 3) {
        toastr.warning('Middle name must be at least 3 characters long');
      return;
    }
    if(opd_number.length < 3) {
        toastr.warning('Record Number or Records number is too short');
      return;
    }

    if(birth_date.length < 3 ) {
        toastr.warning('Birth Date must be entered');
      return;
    }

    if (!gender_id || gender_id === "0") {  // Check if gender is selected or the default "0"
        toastr.warning('Please select gender'); 
        return;
    }

      // Check if pat_id has a value before update
    if (pat_id && method === 'PUT') {

        $.ajax({
          url: pat_id ? '/patients/' + pat_id : '/patients',
          type: method,
          data: $(this).serialize(),
          success: function(response) {
            toastr.success('Patients Updated successfully!');
            
                $('#patient_info')[0].reset();
                $('#pat_id').val('');
          },
          error: function(xhr, status, error) {
            toastr.error('Error updating Patient Information! Try again.');
          }
        });
      } else {
          $.ajax({
            url: '/patients',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
              var result = JSON.parse(response);
                if (result.code === 201) {
                    toastr.success('Patients saved successfully!');
                    $('#patient_info')[0].reset();
                 
                //   Swal.fire({
                //         icon: 'success',
                //         title: 'Success',
                //         text: result.message + ' OPD Number: ' + result.opd_number
                //       });
                } else if (result.code === 200) {
                    toastr.warning('Patient data is available in the system!');
                //   Swal.fire({
                //       icon: 'warning',
                //       title: 'Warning',
                //       text: 'Patient data is available in the system'
                //     });
                }    
            },
              error: function(xhr, status, error) {
              toastr.error('Error saving data! Try again.');
            }
        });
      }
    });

    // ----------------------- PATIENT SEARCH SCRIPT ---------------------------

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
                patient.gender_id === '3' ? 'Male' : 'Female',
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

// ----------------------- /PATIENT SEARCH SCRIPT ---------------------------


// ****************************** GENERATE OPD NUMBER- ****************************----------------------------------------------------------------

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

// ************************** GET ALL PATIENT SPONSORS_?**********************************
$(document).ready(function() {
   
    var patient_id = $('#p_id').val(); // Get the patient_id from the hidden input field

    if (!patient_id) { // Ensure patient_id is not empty
        console.error('Patient ID is missing.');
        return;
    }

    $.ajax({
       url: '/patient/patient-sponsors/' + patient_id,
        type: 'GET',
        success: function(response) {
            // Clear the table body before populating
            var tbody = $('#data_table tbody');
            tbody.empty();

            // Check if response is not empty
            if (response.length > 0) {
                // Loop through the response data and populate the table
                $.each(response, function(index, patient) {
                    var row = '<tr>' +
                        '<td>' + patient.sponsor_name + '</td>' +
                        '<td>' + patient.member_no + '</td>' +
                        '<td>' + patient.start_date + '</td>' +
                        '<td>' + patient.end_date + '</td>' +
                        '<td>' + (patient.status ? 'Active' : 'Inactive') + '</td>' + // Format boolean value
                        '<td>' + patient.priority + '</td>' +
                        // '<td></td>' +
                        '<td>'+
                            '<div class="dropdown" align="center">'+
                                    '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">'+
                                        '<i class="bx bx-dots-vertical-rounded"></i>'+
                                    '</button>'+
                                '<div class="dropdown-menu">'+
                                    '<a class="dropdown-item" href="/patients/${patient.patient_id}">'+
                                        '<i class="bx bx-detail me-1"></i> Edit'+
                                    '</a>'+
                                    '<a class="dropdown-item" href="/patients/${patient.patient_id}">'+
                                        '<i class="bx bx-trash me-1"></i> Delete'+
                                    '</a>'+
                                '</div>'+
                                
                            '</div>'+
                        '</td>' +
                        '</tr>';
                    tbody.append(row);
                });
            } else {
                // If no data is returned, display a message
                tbody.append('<tr><td colspan="8" class="text-center">No data found.</td></tr>');
            }
        },
        error: function(xhr) {
            // Log the error to the console
            console.error('Error fetching patient sponsors:', xhr.responseText);
        }
    });
});
// ************************** GET ALL PATIENT SPONSORS_?**********************************
