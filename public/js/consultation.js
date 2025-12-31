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
        const formData = {
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
            data: formData,
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








// });
