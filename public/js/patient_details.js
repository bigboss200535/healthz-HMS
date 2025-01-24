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
          var gender = $('#gender').val();
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
          var opd_clinic = $('#opd_clinic').val();
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

    if(birth_date.length < 3 ) {
        toastr.warning('Birth Date must be entered');
      return;
    }

    if (!gender || gender === "0") {  // Check if gender is selected or the default "0"
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
            // $("#product_list").load(location.href + " #product_list");
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
                  // $("#product_list").load(location.href + " #product_list");
                  $('#patient_info')[0].reset();
                  Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message + ' OPD Number: ' + result.opd_number
                      });
                } else if (result.code === 200) {
                  Swal.fire({
                      icon: 'warning',
                      title: 'Warning',
                      text: 'Patient data is available in the system'
                    });
                }    
            },
              error: function(xhr, status, error) {
              toastr.error('Error saving data! Try again.');
            }
        });
      }
    });

    // ----------------------- PATIENT SEARCH SCRIPT ---------------------------
  $('#search_item').on('click', function() {
    var search_term = $('#search_patient').val();  // Get the search input value

    if (search_term.trim() !== '') {
        $.ajax({
            url: '/patient/search',
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { search_patient: search_term },
            success: function(response) {
                // Clear the DataTable before appending new data
                var table = $('#patient_search_list').DataTable();
                table.clear();

                if (response.length > 0) {
                    response.forEach(function(patient, index) {
                        var age = calculateAge(patient.birth_date); // Calculate age

                        // Determine the status badge color based on sponsor type
                        var badgeClass = '';
                        switch (patient.sponsor_type_id) {
                            case 'PI03': badgeClass = 'bg-label-info'; break;
                            case 'N002': badgeClass = 'bg-label-danger'; break;
                            case 'PC04': badgeClass = 'bg-label-primary'; break;
                            default: badgeClass = '';
                        }

                        var row = [
                            index + 1, // serial no
                            '<a href="/patients/' + patient.patient_id + '">' + patient.fullname + '</a>', // fullName
                            patient.opd_number, // OPD #
                            (patient.gender_id === '3' ? 'Male' : 'Female'), // Gender
                            age, // Age
                            patient.telephone, // Telephone
                            new Date(patient.birth_date).toLocaleDateString('en-GB'), // birth Date
                            new Date(patient.register_date).toLocaleDateString('en-GB'),
                            '<div class="dropdown" align="center">' +
                                '<button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                                    '<i class="bx bx-dots-vertical-rounded"></i>' +
                                '</button>' +
                                '<div class="dropdown-menu">' +
                                    '<a class="dropdown-item" href="/patients/' + patient.patient_id + '">' +
                                        '<i class="bx bx-detail me-1"></i> More' +
                                    '</a>' +
                                '</div>' +
                            '</div>' // Action
                        ];
                        // Add the row to the DataTable
                        table.row.add(row).draw();
                    });
                } else {
                    // If no results, display a message
                    table.row.add([
                        '', 'No Data Available', '', '', '', '', '', '', ''
                    ]).draw();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('There was an error processing your request. Please try again.');
            }
        });
    } else {
        alert('Please enter a search term');
    }
});
// ----------------------- PATIENT SEARCH SCRIPT ---------------------------

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

// ----------------------- PATIENT SEARCH SCRIPT ---------------------------
// -------GENERATE OPD NUMBER-----------------------------------------------------------------

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
                $('#opd_number').prop('disabled', true);
                $('#opd_number').val(response.result);
            } else if (response.code === 200) {
                $('#opd_number').prop('disabled', false);
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