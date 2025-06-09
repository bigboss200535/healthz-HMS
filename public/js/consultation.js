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
    $('#consultation_tabs').hide();
    $('#required_fields_message').show();
    
    // Handle the Continue button click
    $('#consultation_continue').click(function() {
        // Get form values
        const consultingType = $('#consulting_type').val();
        const consultingEpisode = $('#consulting_episode').val();
        const consultingRoom = $('#consulting_room').val();
        const consultingTime = $('#consulting_time').val();
        const consultingDoctors = $('#consulting_doctors').val();
        const consultingDate = $('#consulting_date').val();
        
        // Validate required fields
        if (!consultingRoom || !consultingDoctors || !consultingDate) {
            toastr.error('Please fill in all required fields');
            return;
        }
        
        // Get patient data from hidden fields
        const patientId = '{{ $attendance->patient_id }}';
        const opdNumber = '{{ $attendance->opd_number }}';
        const genderId = $('#gender_id').val();
        const ageId = $('#age_id').val();
        const patientAge = '{{ $attendance->full_age }}';
        const clinic = '{{ $attendance->pat_clinic }}';
        const patientStatus = 'OUTPATIENT';
        const sponsorType = '{{ $attendance->sponsor_type_id }}';
        const sponsor = '{{ $attendance->sponsor }}';
        const episodeId = $('#episode_id').val();
        const attendanceId = $('#attendance_id').val();
        const attendanceDate = '{{ $attendance->attendance_date }}';
        
        // Prepare data for AJAX request
        const formData = {
            consultation_id: 'CONS-' + Math.floor(Math.random() * 1000000), // This will be overridden by server
            patient_id: patientId,
            opd_number: opdNumber,
            gender_id: genderId,
            age_id: ageId,
            patient_age: patientAge,
            clinic: clinic,
            patient_status: patientStatus,
            sponsor_type: sponsorType,
            sponsor: sponsor,
            episode_id: episodeId,
            episode_type: consultingEpisode,
            consulting_room: consultingRoom,
            prescriber: consultingDoctors,
            attendance_date: attendanceDate,
            consultation_date: consultingDate,
            consultation_type: consultingType,
            consultation_time: consultingTime,
            attendance_id: attendanceId,
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
                    //  $('#consultation_display').show();
                // $('#required_fields_message').hide();
                    
                    // Disable the form fields
                    $('#consulting_type, #consulting_episode, #consulting_room, #consulting_time, #consulting_doctors, #consulting_date').prop('disabled', true);
                    $('#consultation_continue').hide();
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
