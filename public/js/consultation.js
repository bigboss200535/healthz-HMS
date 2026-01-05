// $(document).ready(function() {
    // When systemic area is selected
    $('#systemic_review').change(function() {
        var systemicId = $(this).val();
        if (systemicId) {
            // Clear existing table data
            $('#symptoms-table tbody').empty();
            
            // Fetch symptoms for selected systemic area
            $.ajax({
                url: '/consultation/get-systemic-symptoms/' + systemicId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        // Populate table with symptoms
                        $.each(data, function(index, symptom) {
                            
                            var row = '<tr>' +
                                            '<td align="center"><input type="checkbox" class="form-check-input" name="symptom_check[]" value="' + symptom.systemic_symtom_id + '"></td>' +
                                            '<td>' + symptom.systemic_symtom + '</td>' +
                                            '<td><textarea class="form-control" style="resize: none; min-width:400px; max-width:100%; min-height:50px; height:100%; width:100%;" rows="3" cols="150" name="symptom_notes[' + symptom.systemic_symtom_id + ']"></textarea></td>' +
                                            '<td><div class="btn-group">' +
                                                '<button type="button" class="btn btn-sm btn-primary">Add</button>' +
                                                 '</div>' +
                                            '</td>' +
                                        '</tr>';
                            $('#symptoms-table tbody').append(row);
                        });
                    } else {
                        $('#symptoms-table tbody').append('<tr><td colspan="4" class="text-center">No symptoms found for this system</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching symptoms:', error);
                    $('#symptoms-table tbody').append('<tr><td colspan="4" class="text-center">Error loading symptoms</td></tr>');
                }
            });
        }
    });


    //SAVING CONSULTATION AJAX 
    // Hide the main consultation content initially
     $('#consultation_display').hide(); //hide the main consultation form
     $('#discharge_patient').prop('disabled', true); //disable discharge button initially
    
    // Handle the Continue button click
    $('#consultation_continue').click(function() {
        // Get form values
        const consultingRoom = $('#consulting_room').val();
        const consultingDoctors = $('#consulting_doctors').val();
        const consultingDate = $('#consulting_date').val();

        // Validate required fields
        if (!consultingRoom || !consultingDoctors || !consultingDate) {
            toastr.error('Please fill in all required fields');
            return;
        }
        
        // Prepare data for AJAX request
        const form_data = {
            consultation_id: $('#consultation_id').val(), // This will be overridden by server
            patient_id: $('#con_patient_id').val(),
            opd_number: $('#con_opd_number').val(),
            gender_id: $('#gender_id').val(),
            age_id: $('#age_id').val(),
            patient_age: $('#con_full_age').val(),
            clinic: $('#con_clinic').val(),
            // patient_status_id: '2',
            sponsor_type: $('#con_sponsor_type').val(),
            sponsor: $('#con_sponsor').val(),
            episode_id: $('#episode_id').val(),
            episode_type: $('#consulting_episode').val(),
            consulting_room: consultingRoom,
            prescriber: consultingDoctors,
            attendance_date: consultingDate,
            consultation_date: consultingDate,
            consultation_type: $('#consulting_type').val(),
            consultation_time: $('#consulting_time').val(),
            attendance_id: $('#attendance_id').val(),
            _token: $('input[name="_token"]').val()
        };
        
        // Send AJAX request
        $.ajax({
            url: '/consultation/save',
            type: 'POST',
            data: form_data,
            dataType: 'json',
            beforeSend: function() {
                // Show loading indicator
                $('#consultation_continue').html('<i class="bx bx-loader bx-spin"></i> Processing...');
                $('#consultation_continue').prop('disabled', true);
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Show success message
                    toastr.success(response.message);
                    
                    // Hide the message and show the consultation tabs
                    $('#required_fields_message').hide();
                    $('#consultation_display').show();
                     
                    // Disable the form fields
                    $('#consulting_type, #consulting_episode, #consulting_room, #consulting_time, #consulting_doctors, #consulting_date').prop('disabled', true);
                    // $('#consultation_continue').hide();
                    $('#discharge_patient').prop('disabled', true);
                    // $('#discharge_patient').prop('disabled', false);
                } else {
                    // Show error message
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Parse the error response
                let errorMessage = 'An error occurred while saving the consultation';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                
                // Show error message
                toastr.error(errorMessage);
                
                console.error('Error:', error);
            },
            complete: function() {
                // Reset button state
                $('#consultation_continue').html('Continue to Consult');
                $('#consultation_continue').prop('disabled', false);
            }
        });
    });


// Handle input event on the investigations field
$('#investigation_add').on('input', function () {
  const investigation = $(this).val().trim(); // Get the input value
//   var opd_number = $('#investigation_opdnumber').val();
//    var patient_id = $('#investigation_patient_id').val();
  var attendance_id = $('#investigation_attendance_id').val();
  var service_id = $('#service_id').val(); //service to sort from their sub service
   
  if (!investigation) {
    $('#investigation_results').html('');
    return;
  }

  // Send an AJAX request to fetch matching investigations
  $.ajax({
    url: '/api/investigations/search', 
    method: 'POST',
    data: {
      _token: $('input[name="_token"]').val(), // CSRF token
      investigation_query: investigation, // investigation search term
      attendance_id: attendance_id,
      service_id: service_id
    },
    success: function (response) {
      if (response.length > 0) {
        // Sort the investigations alphabetically by the service name
        const sorted_investigations = response.sort((a, b) => a.service.localeCompare(b.service));

        $('#investigation_results').html('');
       
        sorted_investigations.forEach((investigation) => {
          $('#investigation_results').append(
            `<div class="investigation-item p-2 border-bottom cursor-pointer" 
                  data-service_fee_id="${investigation.service_fee_id}" 
                  data-service_name="${investigation.service}"
                  data-cash_amount="${investigation.cash_amount}">
               ${investigation.service} | 
               <span class="badge bg-label-primary me-1">${investigation.cash_amount}</span>
             </div>`
          );
        });

        // Handle selection of an investigation
        $('.investigation-item').on('click', function () {
          const service_fee_id = $(this).data('service_fee_id');
          const service_name = $(this).data('service_name');
          const cash_amount = $(this).data('cash_amount');

          // Populate the form fields
          $('#service_name').val(service_name);
          $('#service_amount').val(cash_amount);
          // Add hidden field for service_fee_id
          if ($('#service_fee_id').length === 0) {
            $('#add_investigation_form').append('<input type="hidden" id="service_fee_id" name="service_fee_id" value="' + service_fee_id + '">');
          } else {
            $('#service_fee_id').val(service_fee_id);
          }
          // Clear the results container
          $('#investigation_results').html('');
        });
      } else {
        // Display a message if no matching investigations are found
        $('#investigation_results').html('<div class="text-muted">No matching investigations found.</div>');
      }
    },
    error: function (xhr, status, error) {
      console.error('Error fetching investigation details:', error);
      $('#investigation_results').html('<div class="text-danger">An error occurred while fetching investigations.</div>');
    },
  });
});

// Handle service type change to load services dynamically
$('#service_id').on('change', function () {
  const service_type = $(this).val();
  const opd_number = $('#opdnumber').val();
  
  if (!service_type) {
    $('#service_name').val('');
    $('#service_amount').val('');
    return;
  }

  // Send AJAX request to get services by type
  $.ajax({
    url: '/api/investigations/get-investigation-type',
    method: 'POST',
    data: {
      _token: $('input[name="_token"]').val(),
      service_type: service_type,
      opd_number: opd_number
    },
    success: function (response) {
      if (response.length > 0) {
        // Clear previous results
        $('#drug_results').html('');
        
        // Show available services
        response.forEach((service) => {
          $('#drug_results').append(
            `<div class="investigation-item p-2 border-bottom cursor-pointer" 
                  data-service_fee_id="${service.service_fee_id}" 
                  data-service_name="${service.service}"
                  data-cash_amount="${service.cash_amount}">
                  data-service_type_id="${service.service_type_id}">
               ${service.service} (${service.cash_amount}) | 
               <span class="badge bg-label-primary me-1">${service.service}</span>
             </div>`
          );
        });
        
        // Handle selection
        $('.investigation-item').on('click', function () {
          const service_fee_id = $(this).data('service_fee_id');
          const service_name = $(this).data('service_name');
          const cash_amount = $(this).data('cash_amount');
           const service_type_id = $(this).data('service_type_id');

          $('#service_name').val(service_name);
          $('#service_amount').val(cash_amount);
          $('#service_type_id').val(service_type_id);
          
          if ($('#service_fee_id').length === 0) {
            $('#add_investigation_form').append('<input type="hidden" id="service_fee_id" name="service_fee_id" value="' + service_fee_id + '">');
          } else {
            $('#service_fee_id').val(service_fee_id);
          }
          
          $('#drug_results').html('');
        });
      } else {
        $('#drug_results').html('<div class="text-muted">No services found for this type.</div>');
      }
    },
    error: function (xhr, status, error) {
      console.error('Error fetching services:', error);
      $('#drug_results').html('<div class="text-danger">Error loading services.</div>');
    }
  });
});
            // -----------------------INVESTIGATION SUBMISSION FOR SAVING----------------------------
// Function to load Investigations into Data Table
function loadInvestigationsTable() {
  const attendance_id = $('#investigation_attendance_id').val();
  
  if (!attendance_id){
      $('#investigations_table tbody').html('<tr><td colspan="7" class="text-center">No Investigations Found</td></tr>');
    return;
  }
  
  $.ajax({
    url: '/investigations/view-patient-investigations',
    method: 'POST',
    data: {
      _token: $('input[name="_token"]').val(),
      attendance_id: attendance_id
    },
    success: function (response) {
      let tableHtml = '';
      
      if (response.length > 0) {
        response.forEach(function(investigation, index) {
          const status_badge = investigation.status === '2' 
            ? '<span class="badge bg-label-warning">Pending</span>' 
            : '<span class="badge bg-success">Issued</span>';
        
          tableHtml += `
            <tr>
              <td>${index + 1}</td>
               <td>${investigation.investigation_name || '-'} <span class="badge bg-label-primary">${investigation.service_type}  </span></td>
              <td>${investigation.attendance_date || '-'}</td>
              <td>${investigation.requested_by || '-'}</td>
              <td>${status_badge}</td>
              <td>
                  <div class="btn-group" role="group">
                          <button class="btn btn-sm btn-danger delete-investigation" data-id="${investigation.service_request_id}" title="Delete">
                              <i class="bx bx-trash"></i>
                          </button>
                          <button class="btn btn-sm btn-primary edit-investigation" data-id="${investigation.service_request_id}" title="Edit">
                              <i class="bx bx-edit"></i>
                          </button>
                  </div>
              </td>
            </tr>
          `;
        });
      } else {
            tableHtml = '<tr><td colspan="7" class="text-center">No Investigations found</td></tr>';
      }
      
      $('#investigations_table tbody').html(tableHtml);
    },
    error: function (xhr, status, error) {
      console.error('Error loading investigations:', error);
      $('#investigations_table tbody').html('<tr><td colspan="7" class="text-center text-danger">Error loading investigations</td></tr>');
    }
  });
}

// Handle investigation form submission
$('#add_investigation_form').on('submit', function (e) {
  e.preventDefault();
  
  // Validate required fields
  const service_id = $('#service_id').val();
  const investigation_attendance_id = $('#investigation_attendance_id').val();
  const investigation_opdnumber = $('#investigation_opdnumber').val();
  const investigation_patient_id = $('#investigation_patient_id').val();
  const service_fee_id = $('#service_fee_id').val();
  const service_date = $('#service_date').val();
  
  if (!service_id || !investigation_attendance_id || !investigation_patient_id) {
    $('.alert-container-drug').html('<div class="alert alert-danger">Please fill in all required fields.</div>');
    return;
  }
  
  // SHOW LOADING IN THE INVESTIGATION BEFORE SUBMISSION
  $('.alert-container-drug').html('<div class="alert alert-info">Saving Investigation...</div>');
  
  // SUBMIT INVESTIGATION FORM USING AJAX
  $.ajax({
    url: '/investigations/save-investigation',
    method: 'POST',
    data: $(this).serialize(),
    success: function (response) {
      if (response.success) {
        $('.alert-container-drug').html('<div class="alert alert-success">' + response.message + '</div>');
        // Reset form
        $('#add_investigation_form')[0].reset();
        // Reload investigations table
        loadInvestigationsTable();
        // CLEAR ALERT NOTIFICATION AFTER 2 SECONDS
        setTimeout(() => {
           $('.alert-container-drug').html('');
        }, 2000);
      } else {
           $('.alert-container-drug').html('<div class="alert alert-danger">' + response.message + '</div>');
      }
    },
    error: function (xhr, status, error) {
      console.error('Error saving investigation:', error);
      $('.alert-container-drug').html('<div class="alert alert-danger">Error saving Investigation. Please try again.</div>');
    }
  });
});

// Handle delete investigation click
$(document).on('click', '.delete-investigation', function () {
   const service_request_id = $(this).data('id');
  // const service_request_id = $(this).data('service_request_id');

    Swal.fire({
            title: 'Delete Investigation',
            text: 'Are you sure you want to delete this Investigation?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const deleteBtn = $(this);
                const originalHtml = deleteBtn.html();
                deleteBtn.html('<i class="bx bx-loader bx-spin"></i>').prop('disabled', true);
               
                $.ajax({
                    url: `/investigations/delete-investigation/${ service_request_id}`,
                    method: 'GET',
                    data: {
                          service_request_id:service_request_id
                        },
                    success: function(response) {
                        if (response.success) 
                        {
                            toastr.success('Investigation deleted successfully');
                            loadInvestigationsTable();
                        } else {
                            toastr.error('Failed to Delete Investigation');
                        }
                    },
                    error: function(xhr) {
                        const errorMsg = xhr.responseJSON?.message || 'Error Deleting Investigation';
                        toastr.error(errorMsg);
                    },
                    complete: function() {
                        deleteBtn.html(originalHtml).prop('disabled', false);
                    }
                });
            }
        });

});

// Load investigations when page loads
$(document).ready(function() {
    // Load investigations table if attendance_id is available
  if ($('#investigation_attendance_id').val()) {
      loadInvestigationsTable();
  }
});





// DOCUMENT MANAGEMENT FOR CONSULTATION

    // Load all existing documents
    loadDocuments();
    
    // Handle form submission
    $('#document-upload-form').on('submit', function(e) {
        e.preventDefault();
        const patient_id = $('#patient_id').val();
        let form_data = new FormData(this);
        let button = $(this).find('button[type="submit"]');
        let spinner = button.find('.spinner-border');
        let upload_text = button.find('.upload-text');
        
        // Show loading state
        spinner.removeClass('d-none');
        upload_text.text('Uploading...');
        button.prop('disabled', true);
        
        $.ajax({
            url: '/documents/upload/'+ patient_id,
            type: 'POST',
            // data: form_data,
            data: {
                // _token: $('input[name="_token"]').val(),
                form_data: form_data,
                patient_id: patient_id
            },
            processData: false,
            contentType: false,
            success: function(response) {
                // Reset form
                $('#document-upload-form')[0].reset();
                
                // Show success message
                showAlert('success', 'Document uploaded successfully!');
                
                // Reload document list
                loadDocuments();
            },
            error: function(xhr) {
                let errorMessage = 'Upload failed. Please try again.';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = Object.values(xhr.responseJSON.errors).join('<br>');
                }
                showAlert('danger', errorMessage);
            },
            complete: function() {
                // Reset button state
                spinner.addClass('d-none');
                upload_text.text('Upload Document');
                button.prop('disabled', false);
            }
        });
    });
    
    // Function to load documents
    function loadDocuments() {
        $.ajax({
            url: '/documents/list',
            type: 'GET',
            success: function(response) {
                $('#document-list').html(response.html);
            }
        });
    }
    
    // Function to show alerts
    function showAlert(type, message) {
        let alert = `<div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;
        $('#document-list').prepend(alert);
    }


// });
