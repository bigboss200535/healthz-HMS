//********************************** */ SERVICE REQUEST FORM SUBMISSION ***************************** 
$(document).ready(function () {
  // Initialize DataTable
  // const currentattendanceTable = $('#current_attendance').DataTable({
  //     columns: [
  //         { data: 'attendance_id' },
  //         { data: 'attendance_date' },
  //         { data: 'full_age' },
  //         { data: 'pat_clinic' },
  //         { data: 'sponsor' },
  //         { data: 'attendance_type' },
  //         {
  //             data: 'service_issued',
  //             render: function (data) {
  //                 if (data === '0') {
  //                     return '<span class="badge bg-label-danger me-1">Unassigned</span>';
  //                 } else if (data === '1') {
  //                     return '<span class="badge bg-label-success me-1">Assigned</span>';
  //                 }
  //                 return data; // Fallback for unexpected status values
  //             }
  //         },
  //         { data: 'actions', orderable: false }
  //     ]
  // });
// ------------------------------------------------------------------------------------
  // Form submission handler
  $('#service_request_form').on('submit', function (e) {
      e.preventDefault();

      const $form = $(this);
      const formData = new FormData($form[0]);
      const $submitBtn = $('#service_request_save');
      const $closeBtn = $('#reset_close');
      const service_requests = Object.fromEntries(formData.entries());

      if (!service_requests.service_point_id || service_requests.service_point_id === "-Select-"){
        $('#service_point_id').addClass('is-invalid').focus();
        return false;
      }

      if (!service_requests.service_type || service_requests.service_type === "-Select-"){
        $('#service_type').addClass('is-invalid').focus();
        return false;
      }

      if (!service_requests.attendance_date){
        $('#attendance_date').addClass('is-invalid').focus();
        return false;
      }
      if (!service_requests.attendance_type || service_requests.attendance_type === "-Select-"){
        $('#attendance_type').addClass('is-invalid').focus();
        return false;
      }

      $.ajax({
          url: '/services/service_request',
          type: 'POST',
          data: $(this).serialize(),
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          beforeSend: function() {
            $closeBtn.prop('disabled', true);
            $submitBtn.prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm" role="status"></span> Submitting...');

        },
          success: function (response) {
              // Show success message
              $('.alert-container').html(`
                  <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      Attendance Created successfully!
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              `);

              // Reset form
              $('#service_request_form')[0].reset();
              $closeBtn.prop('disabled', false);
              // Refresh the attendance table
              // refresh_attendance_table();
          },
          error: function (xhr) {
              // Show error message
              const errorMessage = xhr.responseJSON?.message || 'An error occurred while creating attendance.';
              $('.alert-container').html(`
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      ${errorMessage}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              `);
              $closeBtn.prop('disabled', false);
          },
          complete: function () {
            $submitBtn.prop('disabled', false).html('<i class="bx bx-save"></i> Submit');
            $closeBtn.prop('disabled', false);
    }
      });
  });
// ---------------------------------------------------------------

  // Function to refresh the attendance table
  function refresh_attendance_table() {
      const patientId = $('#patient_id').val();

      fetch(`/patient/current-attendance/${patientId}`, {
          method: 'GET',
          headers: {
              'Accept': 'application/json',
          },
      })
          .then(response => {
              if (!response.ok) {
                  throw new Error('Network response was not ok');
              }
              return response.json();
          })
          .then(currentResponse => {
              // Clear and update the DataTable
              currentattendanceTable.clear().rows.add(currentResponse.map(current_attendance => ({
                  attendance_id: `<a href="/consultation/opd-consultation/${current_attendance.attendance_id}">${current_attendance.attendance_id}</a>`,
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
                              <a class="dropdown-item" href="/patients/${current_attendance.attendance_id}">
                                  <i class="bx bx-play me-1"></i> Hold
                              </a>
                              <a class="dropdown-item" href="/patients/${current_attendance.attendance_id}">
                                  <i class="bx bx-trash me-1"></i> Delete
                              </a>
                          </div>
                      </div>
                  `
              }))).draw();
          })
          .catch(error => {
              console.error('Error fetching attendance data:', error);
              $('.alert-container').html(`
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      Error fetching attendance data. Please try again later.
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              `);
          });
  }

  // Helper function to format date
  function formatDate(dateString) {
      const date = new Date(dateString);
      return date.toLocaleDateString('en-GB'); // Adjust to your preferred format
  }
});

// -----------------------SAVE CLAIMS CODE -----------------------------
  // Form submission handler
  $('#generate_ccc').on('submit', function (e) {
    e.preventDefault();

    const $form = $(this);
    const formData = new FormData($form[0]);
    const $submitBtn = $('#save_ccc');
    const $closeBtn = $('#reset_ccc');
    const ccc = Object.fromEntries(formData.entries());

    if (!ccc.member_no){
      $('#member_no').addClass('is-invalid').focus();
      return false;
    }

    if (!ccc.claim_code){
      $('#claim_code').addClass('is-invalid').focus();
      return false;
    }

    if (!ccc.start_date){
      $('#start_date').addClass('is-invalid').focus();
      return false;
    }
    if (!ccc.end_date){
      $('#end_date').addClass('is-invalid').focus();
      return false;
    }
    if (!ccc.card_status){
      $('#card_status').addClass('is-invalid').focus();
      return false;
    }

    $.ajax({
        url: '/services/save-ccc',
        type: 'POST',
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function() {
          $closeBtn.prop('disabled', true);
          $submitBtn.prop('disabled', true)
          .html('<span class="spinner-border spinner-border-sm" role="status"></span> Submitting...');

      },
        success: function (response) {
            // Show success message
            $('.alert-container').html(`
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Attendance Created successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);

            // Reset form
            $('#service_request_form')[0].reset();
            $closeBtn.prop('disabled', false);
            // Refresh the attendance table
            refresh_attendance_table();
        },
        error: function (xhr) {
            // Show error message
            const errorMessage = xhr.responseJSON?.message || 'An error occurred while creating attendance.';
            $('.alert-container').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${errorMessage}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            $closeBtn.prop('disabled', false);
        },
        complete: function () {
          $submitBtn.prop('disabled', false).html('<i class="bx bx-save"></i> Submit');
          $closeBtn.prop('disabled', false);
  }
    });
}); 




// //********************************** */ SERVICE REQUEST FORM SUBMISSION ***************************** 

//  ----------------------------------------------------------
//  $(document).ready(function () {
//     var patient_id = $('#p_id').val();
   
//     // Handle form submission
//     $('#save_service_fee').submit(function (e) {
//       e.preventDefault();  

//       $('.is-invalid').removeClass('is-invalid');
//       $('.invalid-feedback').remove();

//       var form_data = $(this).serialize();

//       let isValid = true;
      
//       if ($('#service_point_id').val() === '-Select-') {
//          $('#service_point_id').addClass('is-invalid');
//          $('#service_point_id').after('<div class="invalid-feedback">Please select a clinic.</div>');
//         isValid = false;
//       }

//       if ($('#service_type').val() === '-Select-') {
//          $('#service_type').addClass('is-invalid');
//          $('#service_type').after('<div class="invalid-feedback">Please select a service type.</div>');
//         isValid = false;
//       }

//       if ( $('#credit_amount').empty()) {
//         $('#credit_amount').addClass('is-invalid');
//         $('#credit_amount').after('<div class="invalid-feedback">Please enter a valid Amount.</div>');
//         isValid = false;
//       }

//       if ($('#cash_amount').val() ) {
//         $('#cash_amount').addClass('is-invalid');
//         $('#cash_amount').after('<div class="invalid-feedback">Please enter a valid Amount</div>');
//         isValid = false;
//       }

//       if ($('#attendance_type').val() === '-Select-') {
//          $('#attendance_type').addClass('is-invalid');
//          $('#attendance_type').after('<div class="invalid-feedback">Please select a Attendance Type.</div>');
//         isValid = false;
//       }

//       if (isValid) {
//         $.ajax({
//           url: '/services/patient_service',
//           type: 'POST',
//           data: form_data,
//           dataType: 'json',
//           success: function (response) {
//             if (response.success) {
             
//               var successAlert = $('<div class="alert alert-info alert-dismissible fade show" role="alert">')
//                                 .text('Service submitted!')
//                             $('#success_diplay').prepend(successAlert);
//                             // Automatically remove the alert after 5 seconds
//                             setTimeout(function () {
//                                 successAlert.alert('close');
//                             }, 7000);
//               $('#save_service_fee')[0].reset();// Reset form      
               
//             } else {
//               alert('There was an issue with the submission.');
//             }
//           },
//           error: function (xhr, status, error) {
//             alert('An error occurred: ' + error);
//           }
//         });
//       }
//     });
//   });
// ************************************ clinic dropdown dynamically **************************************************************
  $(document).on('change', '#service_point_id', function() {
    var clinic_id = $(this).val();

    $('#service_type').empty().append('<option disabled selected>-Select-</option>');

    $.ajax({
        url: '/services/' + clinic_id + '/get_specialty',
        type: 'GET',
        success: function(response) {
          if (response.success) {
                $.each(response.result, function(index, service_point) {
                    $('#service_type').append(
                        $('<option></option>').val(service_point.attendance_type_id).text(service_point.attendance_type)
                    );
                });
            } else {
                // If no specialties found, show a message or leave empty
                $('#service_type').append('<option selected disabled>No specialties available</option>');
            }
        },
        error: function(xhr, status, error) {
            toastr.error('Error fetching data! Try again.'); // Display error message if AJAX request fails
        }
    });
});


// --------------------------------GET SERVICE AND THEIR FEE-----------------------------------------
$(document).on('change', '#service_type', function() {
    
    var service = $(this).val();
    var patient_id = $('#patient_id').val();
    var pat_age = $('#p_age').val();

    if (!patient_id || !service) {
      toastr.error('Patient ID, or Service Type is missing.');
      return; // Stop execution if any required field is missing
  }

  // Disable the dropdown and show a spinner
  $(this).prop('disabled', true);
  $('#loading-spinner').show();

    $.ajax({
        url: '/services/' + service + '/service_tarif',
        type: 'GET',
        data: { pat_age:pat_age, service:service, patient_id:patient_id },
        success: function(response) {
          if (response && response.success && Array.isArray(response.result) && response.result.length > 0) {
            
            var service_data = response.result[0]; 
            // Get the first element of the array
          if (service_data.nhis_amount !== undefined && service_data.cash_amount !== undefined && service_data.gdrg !== undefined) {
                    $('#credit_amount').val(service_data.nhis_amount);
                    $('#cash_amount').val(service_data.cash_amount);
                    $('#gdrg_code').val(service_data.gdrg);
                    $('#service_id').val(service_data.service_id);
                    $('#service_fee_id').val(service_data.service_fee_id);
                    // Check if the service is editable
                    if (service_data.editable === "No") {
                      $('#cash_amount').prop('readonly', true);
                      $('#credit_amount').prop('readonly', true);
                  } else {
                      $('#cash_amount').prop('readonly', false);
                      $('#credit_amount').prop('readonly', false);
                  }
          } else {
                    toastr.error('Invalid data structure in response.');
          }

          } else if (response && response.success && Array.isArray(response.result) && response.result.length === 0) {
          toastr.error('No data found for the selected service.');
      } else if (response && !response.success && response.message) {
          toastr.error(response.message);
      } else {
          toastr.error('Unexpected response format');
      }
  },
  error: function(xhr, status, error) {
    if (xhr.status === 404) {
        toastr.error('Resource not found. Please check the URL.');
    } else if (xhr.status === 500) {
        toastr.error('Server error. Please try again later.');
    } else {
        toastr.error('Error fetching data! Try again.');
    }
},
complete: function() {
    // Re-enable the dropdown and hide the spinner
    $('#service_type').prop('disabled', false);
    $('#loading-spinner').hide();
}
});
});
// --------------------------------------------GET DATE FOR attendane_date------------------------------------------------------
document.addEventListener("DOMContentLoaded", function() {
  const dateInput = document.getElementById("attendance_date");
  const today = new Date();
  // Format date as YYYY-MM-DD for the input value
  const formattedDate = today.toISOString().split("T")[0];
  dateInput.value = formattedDate;
});
// -------------------------------------------------------------------------------------------------------------------------------


 // Clear the search field when the "Clear" button is clicked
 $('#clear_search').on('click', function(e){
  e.preventDefault(); // Prevent default link behavior
 $('#search_patient').val('');  // Clear the input field
//  $('#patient_search_list tbody').refresh();  // Clear the table body
});

// });


// ***************************** CCC FUNCTION***************************** ***************************** ***************************** 
function generateCC() {
        var CardNo = $('#member_no').val();
        var CardType = $('#card_type').val();

        const $submitBtn = $('#generate_cc');

        if (!CardNo) {
          toastr.error('Entership Member #');
          return;
        }
        // Perform AJAX request
        $.ajax({
            url: '/api/claims_code',
            type: 'post', 
            data: { CardNo: CardNo, CardType: CardType }, 
            dataType: 'json',
            headers: {
               // Ensure CSRF token is fetched correctly
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
            },
            beforeSend: function() {
                   $('#claim_code').val(''); 
                    $('#start_date').val('')
                    $('#end_date').val('');
                    $('#hin_no').val(''); 
                    $('#card_status').val('');
              $submitBtn.prop('disabled', true)
              .html('<span class="spinner-border spinner-border-sm" role="status"></span> Fetching...');

          },
            success: function(response) {
                if (response.success) {
                  var result = response.data;
                  var current_status = $('#card_status').val().trim();

                    $('#claim_code').val(result.MobCCC || ''); // Set to empty if null
                    $('#start_date').val(result.EligibilityStartDate.split('T')[0])
                    $('#end_date').val(result.EligibilityEndDate.split('T')[0]);
                    $('#hin_no').val(result.HIN); 

                      if(current_status === 'Active') {
                          $('#card_status').val('ACTIVE').css('color', 'green');
                      }else{
                          $('#card_status').val('INACTIVE').css('color', 'red');
                          $submitBtn.prop('disabled', true);
                      }
              
                    $('#fullname').val(result.MemberName);
                    
                    $submitBtn.prop('disabled', false);
                } else {
                    // toastr.error(result.message);
                    $submitBtn.prop('disabled', false)
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                $submitBtn.prop('disabled', false);
            },
            complete: function () {
              $submitBtn.prop('disabled', false).html('Generate CC');
              $restBtn.prop('disabled', false);
      }
        });
      }

function clear_Form() {
    $('#generate_ccc')[0].reset(); // Reset the form
    $('#claim_code').val(''); // Clear specific fields if necessary
    $('#status').val('');
// Add any other fields you want to reset explicitly
}

$('#claims_check_code').on('hidden.bs.modal', function () {
  clear_Form();
});

// ______________________________________________________________________________________________________________________________________________________


  $(document).ready(function () {
    // Handle input event on the diagnosis field
    $('#diagnosis').on('input', function () {

      const diagnosis = $(this).val().trim(); // Get the input value
      var opd_number = $('#opdnumber').val();
       
      if (!diagnosis) {
        $('#diagnosis_results').html('');
        return;
      }

      // Send an AJAX request to fetch matching diagnoses
      $.ajax({
        url: '/services/add-diagnosis', // The route to fetch diagnosis details
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(), // CSRF token
          diagnosis: diagnosis, // Diagnosis search term
          opd_number: opd_number, 
        },
        success: function (response) {
          if (response.length > 0) {
            // Sort the diagnoses alphabetically by the diagnosis name
            const sorted_diagnoses = response.sort((a, b) => a.diagnosis.localeCompare(b.diagnosis));

            // Clear previous results
            $('#diagnosis_results').html('');
           
            // Display the sorted diagnoses in a dropdown or list
            sorted_diagnoses.forEach((diagnosis) => {
              $('#diagnosis_results').append(
                `<div class="diagnosis-item p-2 border-bottom" 
                      data-icd_10="${diagnosis.icd_10}" 
                      data-gdrg_code="${diagnosis.gdrg_code}" 
                      data-diagnosis="${diagnosis.diagnosis}" 
                      data-fee="${diagnosis.adult_tarif}">
                   ${diagnosis.diagnosis} (${diagnosis.icd_10}) | 
                   <span class="badge bg-label-primary me-1">${diagnosis.gdrg_code}</span>
                   <span class="badge bg-label-danger me-1">${diagnosis.adult_tarif}</span>
                 </div>`
              );
            });

            // Handle selection of a diagnosis
            $('.diagnosis-item').on('click', function () {
              const icd_10 = $(this).data('icd_10');
              const gdrg_code = $(this).data('gdrg_code');
              const fee = $(this).data('fee');
              const diagnosis = $(this).data('diagnosis');

              // Populate the form fields
              $('#icd_10').val(icd_10);
              $('#gdrg_code').val(gdrg_code);
              $('#diagnosis_fee').val(fee);
              $('#diagnosis_name').val(diagnosis);

              // Clear the results container
              $('#diagnosis_results').html('');
            });
          } else {
            // Display a message if no matching diagnoses are found
            $('#diagnosis_results').html('<div class="text-muted">No matching diagnoses found.</div>');
          }
        },
        error: function (xhr, status, error) {
          console.error('Error fetching diagnosis details:', error);
          $('#diagnosis_results').html('<div class="text-danger">An error occurred while fetching diagnoses.</div>');
        },
      });
    });
  });

  // __________________________________________________________________________________________________________________________________________________________

    // Handle input event on the diagnosis field
    $('#prescription_add').on('input', function () {

      const prescription = $(this).val().trim(); // Get the input value
      var opd_number = $('#opdnumber').val();
       
      if (!prescription) {
        $('#drug_results').html('');
        return;
      }

      // Send an AJAX request to fetch matching diagnoses
      $.ajax({
        url: '/prescriptions/search', 
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(), // CSRF token
          prescription: prescription, // prescription search term
          opd_number: opd_number, 
        },
        success: function (response) {
          if (response.length > 0) {
            // Sort the prescription alphabetically by the prescription name
            const sorted_drugs = response.sort((a, b) => a.prescription.localeCompare(b.prescription));

            $('#drug_results').html('');
           
            sorted_drugs.forEach((drugs) => {
              $('#drug_results').append(
                `<div class="prescription-item p-2 border-bottom" 
                      data-product_name="${drugs.product_name}" 
                      data-average_unit_price="${drugs.average_unit_price}">
                   ${drugs.product_name} (${drugs.average_unit_price}) | 
                   <span class="badge bg-label-primary me-1">${drugs.product_name}</span>
                 </div>`
              );
            });

            // Handle selection of a diagnosis
            $('.drug-item').on('click', function () {
              // const gdrg_code = $(this).data('gdrg_code');
              const average_unit_price = $(this).data('average_unit_price');
              const product_name = $(this).data('product_name');

              // Populate the form fields
              $('#average_unit_price').val(average_unit_price);
              $('#product_name').val(product_name);
              // Clear the results container
              $('#drug_results').html('');
            });
          } else {
            // Display a message if no matching diagnoses are found
            $('#drug_results').html('<div class="text-muted">No matching diagnoses found.</div>');
          }
        },
        error: function (xhr, status, error) {
          console.error('Error fetching Prescription details:', error);
          $('#_results').html('<div class="text-danger">An error occurred while fetching Prescription.</div>');
        },
      });
    });
  // });




    $(document).on('click', '.attendance_delete_btn', function() {
      var attendance_id = $(this).data('id');

      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: `/attendance/delete-attendance/${ attendance_id}`,
            // type: 'json',
            data: {
              _token: '{{ csrf_token() }}',
              attendance_id: attendance_id
            },
            success: function(response) {
              // var result = JSON.parse(response);
              if (response.code === 201) {
                $("#app_list").load(location.href + " #app_list");
                toastr.success(response.message);
              } else if ([200, 403, 404].includes(response.code)) {
                toastr.warning(response.message);
              }
              // else if (response.code == 101) {
              //   toastr.warning(response.message);
              // }
              // else if (response.code == 200) {
              //   toastr.warning(response.message);
              // }
              
            },
            error: function(xhr, status, error) {
              toastr.error(xhr.responseJSON?.message || 'An error occurred while deleting the attendance.');
            }
          });
        }
      });
    });
