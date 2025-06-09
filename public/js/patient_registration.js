//*************************************************** */ PATIENT REGISTRATION FORM

// Handle form submission
    $('#patient_info_create').on('submit', function(e) {
        e.preventDefault();

        // Initialize buttons
        const $form = $(this);
        const $submitBtn = $('#save_patient_info');
        const $restBtn = $('#reset_button');

        const original_text = $submitBtn.html();
        const formData = new FormData($form[0]);
        const patient_save = Object.fromEntries(formData.entries());

        $restBtn.prop('disabled', true);
        // const $form = $('#patient_info_create');
       
        // Client-side validation with improved feedback
        if (!patient_save.title || patient_save.title === "-Select-"){
            $('#title').addClass('is-invalid').focus();
            return false;
        }

        if (!patient_save.firstname || patient_save.firstname === ""){
            $('#firstname').addClass('is-invalid').focus();
            return false;
        }

        if (!patient_save.lastname || patient_save.lastname === ""){
            $('#lastname').addClass('is-invalid').focus();
            return false;
        }

        // Validate birth date is not in future
       if (patient_save.birth_date) {
            const birthDate = new Date(patient_save.birth_date);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time part for accurate comparison
            
            if (birthDate > today) {
                $('#birth_date').addClass('is-invalid')
                            .after('<div class="invalid-feedback">Birth date cannot be in the future</div>')
                            .focus();
                return false;
            }
        }
        
        if (!patient_save.gender_id || patient_save.gender_id === "-Select-"){
            $('#gender_id').addClass('is-invalid').focus();
            return false;
        }

        if (!patient_save.education || patient_save.education === "-Select-"){
            $('#education').addClass('is-invalid').focus();
            return false; 
        }

        if (!patient_save.religion || patient_save.religion === "-Select-"){
            $('#religion').addClass('is-invalid').focus();
            return false;
        }

        if (!patient_save.folder_clinic || patient_save.folder_clinic === "-Select-"){
            $('#folder_clinic').addClass('is-invalid').focus();
            return false;
        }

        if (!patient_save.opd_type || patient_save.opd_type === "-Select-"){
            $('#opd_type').addClass('is-invalid')
                          .focus()
                          .after('<div class="invalid-feedback">Kindly Select Opd type</div>');
            return false;
        }


        if (!patient_save.sponsor_type_id || patient_save.sponsor_type_id === "-Select-") {
            // if (!patient_save.sponsor_id || patient_save.sponsor_id === "-Select-") {
                $('#sponsor_type_id').addClass('is-invalid').focus();
                return false;
            // }
        }

        // Enhanced validation for OPD number format
        if (!patient_save.opd_number || patient_save.opd_number === "") {
            $('#opd_number').addClass('is-invalid')
                           .after('<div class="invalid-feedback">OPD number is required</div>')
                           .focus();
            return false;
        }

        // Determine URL and method based on pat_id
        const url = patient_save.pat_id ? `/patients/${patient_save.pat_id}` : '/patients';
        const method = patient_save.pat_id ? 'PUT' : 'POST';

                // AJAX request with improved error handling and feedback
                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        $restBtn.prop('disabled', true);
                        $submitBtn.prop('disabled', true)
                        .html('<span class="spinner-border spinner-border-sm" role="status"></span> Submitting...');
                    },
                    success: function (response) {
                        if (response.code === 201) {
                            toastr.success(response.message || 'Patient saved successfully');
                            $form[0].reset();
                            $('#pat_id').val('');
                            $('.is-invalid').removeClass('is-invalid');

                            // Reload the app_list table
                            if ($('#patient_list').length) {
                                $('#patient_list').DataTable().ajax.reload();
                            }
                            $submitBtn.prop('disabled', false);
                            $restBtn.prop('disabled', false);
                        } else if (response.code === 200) {
                            toastr.warning(response.message || 'Patient data already exists');
                            $submitBtn.prop('disabled', false);
                            $restBtn.prop('disabled', false);
                        } else if(response.code === 200){
                            toastr.error(response.message);
                            $submitBtn.prop('disabled', false);
                            $restBtn.prop('disabled', false);
                        }else {
                            toastr.error(response.message || 'Error saving patient data');
                            $submitBtn.prop('disabled', false);
                            $restBtn.prop('disabled', false);
                        }                  
                    },
                    error: function (xhr, status, error) {
                        let errorMessage = xhr.responseJSON?.message || 'Error saving patient data';
                        toastr.error(errorMessage);
                        $submitBtn.prop('disabled', false);
                        $restBtn.prop('disabled', false);
                        $('.is-invalid').removeClass('is-invalid');
                        $('.invalid-feedback').remove();
                    },
                    complete: function () {
                            $submitBtn.prop('disabled', false).html('<i class="bx bx-save"></i> Save Patient');
                            $restBtn.prop('disabled', false);
                    }
                });
        // }

    });


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
// *************************** end GENERATE OPD NUMBER *****************************/


// When sponsor type changes
$('#sponsor_type_id').on('change', function() {
        var sponsorTypeId = $(this).val();
        if(sponsorTypeId) {
            // Clear current options
            $('#sponsor_id').empty();
            $('#sponsor_id').append('<option value="" disabled selected>-Loading Sponsors-</option>');
            
            // Make AJAX request to get sponsors by type
            $.ajax({
                // url: '{{ route("get.sponsors.by.type") }}',
                url: '/api/getsponsortype',
                type: 'GET',
                data: {
                    sponsor_type_id: sponsorTypeId
                },
                success: function(data) {
                    $('#sponsor_id').empty();
                    $('#sponsor_id').append('<option value="" disabled selected>-Select-</option>');
                    
                    // Add the returned sponsors to the dropdown
                    $.each(data, function(key, value) {
                        $('#sponsor_id').append('<option value="' + value.sponsor_id + '">' + value.sponsor_name.toUpperCase() + '</option>');
                    });
                    
                    // Refresh Select2 to apply changes
                    $('#sponsor_id').trigger('change');
                },
                error: function() {
                    $('#sponsor_id').empty();
                    $('#sponsor_id').append('<option value="" disabled selected>-Error Loading Sponsors-</option>');
                }
            });
            
            // Set member number format based on sponsor type
            if(sponsorTypeId === 'N002') {
                // For N002, set min and max length
                $('.sponsorship_details_settings').show();
                $('#member_no').attr('minlength', '8');
                $('#member_no').attr('maxlength', '10');
                $('#member_no').attr('pattern', '[0-9]{8,10}');
                $('#member_no').attr('title', 'Member number must be 8-10 digits');

            }else if(sponsorTypeId === 'P001'){	
                
                $('#member_no').val('');
                $('#sponsor_id').empty();
                $('#start_date').val('');
                $('#end_date').val('');
                $('#card_status').val('');
               
                $('.sponsorship_details_settings').hide();
                // $('#member_no').removeAttr('title');
                
            } else {
                $('.sponsorship_details_settings').show();
                // For other sponsor types, remove restrictions
                $('#member_no').removeAttr('minlength');
                $('#member_no').removeAttr('maxlength');
                $('#member_no').removeAttr('pattern');
                $('#member_no').removeAttr('title');
            }
        } else {
            // If no sponsor type selected, clear and reset sponsor dropdown
            $('#sponsor_id').empty();
            $('#sponsor_id').append('<option value="" disabled selected>-Select-</option>');
            
            // Reset member number field
            $('#member_no').removeAttr('minlength');
            $('#member_no').removeAttr('maxlength');
            $('#member_no').removeAttr('pattern');
            $('#member_no').removeAttr('title');
        }
    });

    // Function to check date range and update card status
    function updateCardStatus() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        
        if(startDate && endDate) {
            var today = new Date();
            var start = new Date(startDate);
            var end = new Date(endDate);
            
            // Reset time part to compare dates only
            today.setHours(0, 0, 0, 0);
            start.setHours(0, 0, 0, 0);
            end.setHours(0, 0, 0, 0);
            
            if(today >= start && today <= end) {
                $('#card_status').val('Active');
                $('#card_status').css('color', 'green');
            } else {
                $('#card_status').val('Inactive');
                $('#card_status').css('color', 'red');
            }
        } else {
            $('#card_status').val('');
        }
    }

    // Update card status when start date or end date changes
    $('#start_date, #end_date').on('change', function() {
        updateCardStatus();
    });


    //********************************************************* */ PATIENT FETCH MODIFICATIONS

// $(document).ready(function() {
    // Handle edit button click
    $('.edit-patient').on('click', function(e) {
        e.preventDefault();
        var patient_id = $(this).data('patient-id');
        
        // Show loading indicator
        $('#patient_info_create').addClass('btn-submitting');
        
        // AJAX request to fetch patient data
        $.ajax({
            url: '/patients/' + patient_id + '/edit',
            method: 'GET',
            success: function(response) {
                // Populate form fields with response data
                $('#pat_id').val(response.patient_id);
                $('#title').val(response.title_id);
                $('#firstname').val(response.firstname);
                $('#middlename').val(response.middlename);
                $('#lastname').val(response.lastname);
                $('#birth_date').val(response.birth_date);
                $('#gender_id').val(response.gender_id);
                $('#occupation').val(response.occupation);
                $('#religion').val(response.religion);
                $('#nationality').val(response.nationality);
                $('#ghana_card').val(response.ghana_card);
                $('#telephone').val(response.telephone);
                $('#work_telephone').val(response.work_telephone);
                $('#email').val(response.email);
                $('#address').val(response.address);
                $('#town').val(response.town);
                $('#region').val(response.region);
                $('#education').val(response.education);
                // $('#contact_relationship').val(response.contact_relationship);
                // $('#contact_telephone').val(response.contact_telephone);
                $('#sponsor_type_id').val(response.sponsor_type_id);
                $('#sponsor_id').val(response.sponsor_id);
                $('#member_no').val(response.member_no);
                $('#dependant').val(response.dependant);
                $('#start_date').val(response.start_date);
                $('#end_date').val(response.end_date);
                $('#card_status').val(response.card_status);
                $('#opd_type').val(response.opd_type);
                $('#folder_clinic').val(response.folder_clinic);
                $('#opd_number').val(response.opd_number);
                $('#age').val(response.pat_age)
                
                 $('#emergencyContactsContainer').empty();

                // Populate emergency contacts
                    if (response.emergency_contacts && response.emergency_contacts.length > 0) {
                        response.emergency_contacts.forEach((contact, index) => {
                            const contactHtml = `
                                <div class="row mb-3 emergency-contact">
                                    <table class="table table-hover">
                              <td>
                                <div class="col">
                                  <label class="form-label" for="contact_person">Fullname</label>
                                  <input type="text" class="form-control" name="contact_person[]" value="${contact.relation_name || ''}" placeholder="eg. JANE DOE">
                                </div>
                              </td>
                              <td>
                                <div class="col">
                                  <label class="form-label" for="contact_relationship">Relationship</label>
                                  <select name="contact_relationship[]" class="form-control">
                                      <option disabled selected>-Select-</option>
                                      @foreach($relation as $rel)                                        
                                          <option value="{{ $rel->relation_id }}" ${contact.relation_id == '{{ $rel->relation_id }}' ? 'selected' : ''}>{{ strtoupper($rel->relation) }}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </td>
                              <td>
                                <div class="col">
                                  <label class="form-label" for="contact_telephone">Telephone</label>
                                   <input type="text" class="form-control" name="contact_telephone[]" value="${contact.contact || ''}" placeholder="0xxxxxxxxx" autocomplete="off">
                                </div>
                              </td>
                              <td>
                              <td>
                                  <button class='btn btn-danger' data-id=""><i class="bx bx-trash"></i></button>
                              </td>
                              </td>
                           </table>
                                </div>
                            `;
                            $('#emergencyContactsContainer').append(contactHtml);
                        });
                        } else {
                            // Add at least one emergency contact field
                            $('#emergencyContactsContainer').append($('.emergency-contact').first().clone());
                        }

                // Hide loading indicator
                $('#patient_info_create').removeClass('btn-submitting');
            },
            error: function(xhr) {
                toastr.warning("Error Fetching Patient");
                $('#patient_info_create').removeClass('btn-submitting');
            }
        });
    });
// });

