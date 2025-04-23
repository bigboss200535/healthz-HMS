
    // Handle form submission
    $('#patient_info_create').on('submit', function(e) {
        e.preventDefault();
        const $form = $('#patient_info_create');

        // Get form elements
        const submitBtn = $form.find('button[type="submit"]');
        const resetBtn = $form.find('button[type="reset"]');
        const searchBtn = $form.find('a.btn-dark');
        const formOverlay = $('<div class="form-overlay"><div class="spinner-border text-primary"></div></div>');

        // Check if form is already being submitted
        if (submitBtn.prop('disabled')) {
            toastr.warning('Form submission in progress, please wait...');
            return;
        }

        // Clear any previous error states
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        toastr.clear();
    
        //    remove the loading overlay is alreading loading
        formOverlay.fadeOut(function() {
                    $(this).remove();
                });

        // Add loading overlay
        $form.css('position', 'relative').append(formOverlay);
        formOverlay.fadeIn();

        // Get CSRF token from meta tag
        const token = $('meta[name="csrf-token"]').attr('content');
        if (!token) {
            toastr.error('CSRF token not found. Please refresh the page.');
            return;
        }

        // Collect and validate form data
        const formData = new FormData($form[0]);
        const patient_save = Object.fromEntries(formData.entries());

        // Trim text inputs
        ['firstname', 'middlename', 'lastname'].forEach(field => {
            if (patient_save[field]) {
                patient_save[field] = patient_save[field].trim();
                formData.set(field, patient_save[field]);
            }
        });


        // Client-side validation with improved feedback
        const validationRules = [
            { field: 'title', value: patient_save.title, message: 'Please select a title', condition: !patient_save.title || patient_save.title === "-Select-" },
            { field: 'firstname', value: patient_save.firstname, message: 'Firstname cannot be empty', condition: !patient_save.firstname },
            { field: 'firstname', value: patient_save.firstname, message: 'First name must be at least 3 characters long', condition: patient_save.firstname || patient_save.firstname.length < 3 },
            { field: 'lastname', value: patient_save.lastname, message: 'Lastname cannot be empty', condition: !patient_save.lastname},
            { field: 'lastname', value: patient_save.lastname, message: 'Lastname must be at least 3 characters long', condition: patient_save.lastname || patient_save.lastname.length < 3 },
            { field: 'birth_date', value: patient_save.birth_date, message: 'Birth Date must be entered', condition: !patient_save.birth_date },
            { field: 'gender_id', value: patient_save.gender_id, message: 'Please select gender', condition: !patient_save.gender_id || patient_save.gender_id === "-Select-" },
            { field: 'occupation', value: patient_save.occupation, message: 'Please select occupation', condition: !patient_save.occupation || patient_save.occupation === "-Select-" },
            { field: 'education', value: patient_save.education, message: 'Please select education level', condition: !patient_save.education || patient_save.education === "-Select-" },
            { field: 'religion', value: patient_save.religion, message: 'Please select religion', condition: !patient_save.religion || patient_save.religion === "-Select-" },
            { field: 'nationality', value: patient_save.nationality, message: 'Please select nationality', condition: !patient_save.nationality || patient_save.nationality === "-Select-" },
            { field: 'telephone', value: patient_save.telephone, message: 'Please enter a valid phone number', condition: patient_save.telephone && !/^\+?\d{10,15}$/.test(patient_save.telephone) },
            { field: 'work_telephone', value: patient_save.work_telephone, message: 'Please enter a valid work phone number', condition: patient_save.work_telephone && !/^\+?\d{10,15}$/.test(patient_save.work_telephone) },
            { field: 'email', value: patient_save.email, message: 'Please enter a valid email address', condition: patient_save.email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(patient_save.email) },
            { field: 'contact_telephone', value: patient_save.contact_telephone, message: 'Please enter a valid emergency contact number', condition: patient_save.contact_telephone && !/^\+?\d{10,15}$/.test(patient_save.contact_telephone) },
            { field: 'sponsor_type_id', value: patient_save.region, message: 'Please select a sponsor type', condition: !patient_save.sponsor_type_id || patient_save.sponsor_type_id === "-Select-" },
            { field: 'folder_clinic', value: patient_save.region, message: 'Please select a Clinic', condition: !patient_save.folder_clinic || patient_save.folder_clinic === "-Select-" },
            { field: 'opd_number', value: patient_save.opd_number, message: 'Record Number is invalid', condition: patient_save.opd_number && patient_save.opd_number.length < 3 }
        ];

        // Additional validation for required contact person details
        if (patient_save.contact_person || patient_save.contact_telephone || patient_save.contact_relationship) {
            if (!patient_save.contact_person) {
                validationRules.push({ field: 'contact_person', value: patient_save.contact_person, message: 'Emergency contact name is required', condition: true });
            }
            if (!patient_save.contact_relationship) {
                validationRules.push({ field: 'contact_relationship', value: patient_save.contact_relationship, message: 'Emergency contact relationship is required', condition: true });
            }
            if (!patient_save.contact_telephone) {
                validationRules.push({ field: 'contact_telephone', value: patient_save.contact_telephone, message: 'Emergency contact phone is required', condition: true });
            }
        }

        // Check sponsorship details if sponsor type is selected
        if (patient_save.sponsor_type_id && patient_save.sponsor_type_id !== "-Select-") {
            if (!patient_save.sponsor_id || patient_save.sponsor_id === "-Select-") {
                // toastr.warning('Please select a sponsor');
                $('#sponsor_id').addClass('is-invalid').focus();
                return;
            }
            if (!patient_save.member_no) {
                // toastr.warning('Please enter member number');
                $('#member_no').addClass('is-invalid').focus();
                return;
            }
            if (!patient_save.start_date) {
                // toastr.warning('Please enter start date');
                $('#start_date').addClass('is-invalid').focus();
                return;
            }
            if (!patient_save.end_date) {
                // toastr.warning('Please enter end date');
                $('#end_date').addClass('is-invalid').focus();
                return;
            }
        }

        // Validate all rules
        let hasError = false;
        for (const rule of validationRules) {
            const field = $(`#${rule.field}`);
            if (rule.condition) {
                field.addClass('is-invalid');
                if (!field.next('.invalid-feedback').length) {
                    field.after(`<div class="invalid-feedback">${rule.message}</div>`);
                }
                if (!hasError) {
                    field.focus();
                    hasError = true;
                }
                // toastr.warning(rule.message);
            } else {
                field.removeClass('is-invalid');
                field.next('.invalid-feedback').remove();
            }
        }

        if (hasError) {
            return;
        }

        // Disable form buttons and show loading state
        submitBtn.prop('disabled', true)
                .html('<i class="bx bx-loader bx-spin"></i> Saving...');
        resetBtn.prop('disabled', true);
        searchBtn.addClass('disabled');

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
                'X-CSRF-TOKEN': token
            },
            beforeSend: function() {
                formOverlay.fadeIn();
            },
            success: function (response) {
                if (response.code === 201) {
                    toastr.success(response.message || 'Patient saved successfully');
                    $form[0].reset();
                    $('#pat_id').val('');
                    $('.is-invalid').removeClass('is-invalid');
                    $('.invalid-feedback').remove();
                    submitBtn.prop('disabled', false);
                } else if (response.code === 200) {
                    toastr.warning(response.message || 'Patient data already exists');
                } else {
                    toastr.error(response.message || 'Error saving patient data');
                }
            },
            error: function (xhr, status, error) {
                let errorMessage = xhr.responseJSON?.message || 'Error saving patient data';
                toastr.error(errorMessage);
                
                if (xhr.responseJSON?.errors) {
                    Object.entries(xhr.responseJSON.errors).forEach(([field, messages]) => {
                        const input = $(`#${field}`);
                        if (input.length) {
                            input.addClass('is-invalid')
                                 .after(`<div class="invalid-feedback">${messages[0]}</div>`);
                            
                            if (!input.is(':visible')) {
                                input.closest('.collapse').collapse('show');
                            }
                        }
                    });
                    $('.is-invalid:first').focus();
                }
            },
            complete: function () {
                submitBtn.prop('disabled', false)
                         .html('<i class="bx bx-save"></i> Save Patient');
                resetBtn.prop('disabled', false);
                searchBtn.removeClass('disabled');
                formOverlay.fadeOut(function() {
                    $(this).remove();
                });
            }
        });

    });


// When sponsor type changes
$('#sponsor_type_id').on('change', function() {
        var sponsorTypeId = $(this).val();
        if(sponsorTypeId) {
            // Clear current options
            $('#sponsor_id').empty();
            $('#sponsor_id').append('<option value="" disabled selected>-Loading Sponsors-</option>');
            
            // Make AJAX request to get sponsors by type
            $.ajax({
                url: '{{ route("get.sponsors.by.type") }}',
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
                $('#member_no').attr('minlength', '8');
                $('#member_no').attr('maxlength', '10');
                $('#member_no').attr('pattern', '[0-9]{8,10}');
                $('#member_no').attr('title', 'Member number must be 8-10 digits');
            } else {
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

