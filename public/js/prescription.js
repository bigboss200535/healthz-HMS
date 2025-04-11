// Prescription management functionality
$(document).ready(function() {
    // Initialize prescription search with autocomplete
    $('#pres_search').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/api/search-prescription',
                method: 'GET',
                data: { query: request.term },
                success: function(data) {
                    response(data.map(function(item) {
                        return {
                            label: item.product_name,
                            value: item.product_name,
                            id: item.product_id
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            $('#pres_search').val(ui.item.id);
            return true;
        }
    });

    // Handle prescription form submission
    $('#add_prescription_form').submit(function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '/api/save-prescription',
            method: 'POST',
            data: {
                opd_number: $('#pres_opdnumber').val(),
                patient_id: $('#patient_id').val(),
                pres_product_id: $('#pres_product_id').val(),
                dosage: $('#pres_dosage').val(),
                frequency: $('#pres_frequency').val(),
                duration: $('#pres_duration').val(),
                quantity: $('#pres_qty').val(),
                price: $('#pres_price').val(),
                type: $('#pres_type').val(),
                start_date: $('#pres_start_date').val(),
                end_date: $('#pres_end_date').val(),
                pres_sponsor: $('#pres_sponsor').val(),
                pres_gdrg: $('#pres_gdrg').val(),
                _token: $('input[name="_token"]').val()
            },
            success: function(response) {
                if (response.success) {
                    // Show success message
                    $('.alert-container').html(
                        '<div class="alert alert-success">Prescription added successfully</div>'
                    );
                    
                    // Refresh prescription table
                    refreshPrescriptionTable();
                    
                    // Reset form
                    $('#add_prescription_form')[0].reset();
                    
                    // Close modal after delay
                    setTimeout(function() {
                        $('#add_prescriptions').modal('hide');
                        $('.alert-container').html('');
                    }, 2000);
                }
            },
            error: function(xhr) {
                $('.alert-container').html(
                    '<div class="alert alert-danger">Error saving prescription</div>'
                );
            }
        });
    });

    // Function to refresh prescription table
    function refreshPrescriptionTable() {
        $.ajax({
            url: '/api/get-prescriptions/' + $('#opdnumber').val(),
            method: 'GET',
            success: function(data) {
                let tableBody = '';
                data.forEach(function(item, index) {
                    tableBody += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>
                                ${item.product_name}<br>
                                <small class="text-muted">
                                    ${item.dosage} MLS, ${item.frequencies}, ${item.duration}
                                </small>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-danger delete-prescription" data-id="${item.attendance_diagnosis_id}">
                                    <i class="bx bx-trash"></i>
                                </button>
                                <button class="btn btn-sm btn-primary edit-prescription" data-id="${item.attendance_diagnosis_id}">
                                    <i class="bx bx-edit"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
                $('#drugs tbody').html(tableBody);
            }
        });
    }

    // Handle prescription deletion
    $(document).on('click', '.delete-prescription', function() {
        if (confirm('Are you sure you want to delete this prescription?')) {
            const prescriptionId = $(this).data('id');
            $.ajax({
                url: '/api/delete-prescription/' + prescriptionId,
                method: 'DELETE',
                data: {
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        refreshPrescriptionTable();
                    }
                }
            });
        }
    });

    // Handle prescription edit
    $(document).on('click', '.edit-prescription', function() {
        const prescriptionId = $(this).data('id');
        // Load prescription data and populate form
        $.ajax({
            url: '/api/get-prescription/' + prescriptionId,
            method: 'GET',
            success: function(data) {
                $('#prescription_add').val(data.medication_name);
                $('#medication_id').val(data.medication_id);
                $('#dosage').val(data.dosage);
                $('#category').val(data.frequency_id);
                $('#principal').val(data.duration);
                
                // Show modal
                $('#add_prescriptions').modal('show');
            }
        });
    });

    // Initialize the prescription table on page load
    refreshPrescriptionTable();
});