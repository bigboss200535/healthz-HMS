// ********************** DIAGNOSIS SCRIPT*******************************************************************************
//    DIAGNOSIS-SIDE     DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE    DIAGNOSIS-SIDE 

// Function to refresh diagnosis table
   function refreshDiagnosisTable() {

    const loadingRow = '<tr><td colspan="9" class="text-center"><i class="bx bx-loader bx-spin me-2"></i>Loading diagnoses...</td></tr>';
    
    $('#diagnosis_list tbody').html(loadingRow);
    
    $.ajax({
        url: '/api/get-diagnosis/' + $('#diag_attendance_id').val(),
        method: 'GET',
        success: function(data) {
            let tableBody = '';
            if (data.length === 0) {
                tableBody = '<tr><td colspan="9" class="text-center text-muted">No diagnoses found</td></tr>';
            } else {
                data.forEach(function(item, index) {
                    tableBody += `
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td>${item.diagnosis}</td>
                            <td class="text-center">${item.icd_10 || '-'}</td>
                            <td class="text-center">${item.gdrg_code || '-'}</td>
                            <td class="text-center">${item.is_principal || '-'}</td>
                            <td class="text-center">${item.diagnosis_category || '-'}</td>
                            <td class="text-center">${item.doctor_name || '-'}</td>
                            <td class="text-center">${item.entry_date || '-'}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-sm btn-danger delete-diagnosis" data-id="${item.diagnosis_table_id}" title="Delete">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary edit-diagnosis" data-id="${item.diagnosis_table_id}" title="Edit">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    `;
                });
            }
            
            // Make sure the table has a tbody element
            if ($('#diagnosis_list tbody').length === 0) {
                $('#diagnosis_list').append('<tbody></tbody>');
            }
            
            $('#diagnosis_list tbody').html(tableBody);
            // Initialize tooltips
            $('[title]').tooltip();
        },
        error: function() {
            const errorRow = '<tr><td colspan="9" class="text-center text-danger"><i class="bx bx-error-circle me-2"></i>Error loading diagnoses</td></tr>';
            $('#diagnosis_list tbody').html(errorRow);
            toastr.error('Failed to load diagnoses. Please try again.');
        }
    });
}

// Initialize diagnosis search with custom dropdown
let searchTimeout;
let resultsDiv = $('<div id="diagnosis_results" class="diagnosis-results"></div>')
    .insertAfter('#diagnosis_search')
    .hide()
    .css({
        'position': 'absolute',
        'z-index': '1000',
        'background': 'white',
        'border': '2px solid #ddd',
        'max-height': '200px',
        'overflow-y': 'auto',
        'width': 'auto'
        // 'width': $('#diagnosis_search').outerWidth() + 'px'
    });

$('#diagnosis_search').on('input', function() {
    let searchTerm = $(this).val().trim();
    clearTimeout(searchTimeout);

    if (searchTerm.length < 2) {
        resultsDiv.hide();
        return;
    }

    searchTimeout = setTimeout(function() {
        $.ajax({
            url: '/api/search-diagnosis',
            method: 'GET',
            data: { 
                diagnosis_query: searchTerm,
                patient_id: $('#diag_patient_id').val(),
                opd_number: $('#diag_opdnumber').val() 
            },
            beforeSend: function() {
                resultsDiv.html('<div class="p-2 text-center">Searching...</div>').show();
            },
            success: function(data) {
                if (data.length === 0) {
                    resultsDiv.html('<div class="p-2 text-center">No diagnosis Found</div>');
                    return;
                }
                
                let results = data.map(function(item) {
                    return `<div class="diagnosis-item p-2 cursor-pointer hover:bg-gray-100" 
                                data-id="${item.diagnosis_id}" 
                                data-name="${item.diagnosis}"
                                data-icd10="${item.icd_10 || ''}"
                                data-gdrg="${item.gdrg_code || ''}"
                                data-fee="${item.adult_tarif || 0}">
                                <div class="font-semibold">${item.diagnosis} | ${item.icd_10 ? '<span class="badge bg-label-primary">' + item.icd_10 : ''} </span> | ${item.gdrg_code ? '<span class="badge bg-label-danger">' + item.gdrg_code : ''} </span></div>
                                
                            </div>`;
                }).join('');
                
                resultsDiv.html(results).show();
            },
            error: function() {
                resultsDiv.html('<div class="p-2 text-center text-red-600">Error fetching results</div>');
            }
        });
    }, 300);
});

// Handle click outside to close results
$(document).on('click', function(e) {
    if (!$(e.target).closest('#diagnosis_search, #diagnosis_results').length) {
        resultsDiv.hide();
    }
});

// Handle diagnosis selection
$(document).on('click', '.diagnosis-item', function() {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const icd10 = $(this).data('icd10');
    const gdrg = $(this).data('gdrg');
    const fee = $(this).data('fee');
    
    $('#diagnosis_search').val(name);
    $('#diag_id').val(id);
    $('#diag_icd_10').val(icd10);
    $('#diag_gdrg').val(gdrg);
    $('#diag_fee').val(fee);
    
    resultsDiv.hide();
});

// Handle clicking on diagnosis items in the results div
$(document).on('click', '.diagnosis-item', function() {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const icd10 = $(this).data('icd10');
    const gdrg = $(this).data('gdrg');
    const fee = $(this).data('fee');
    
    $('#diagnosis_search').val(name);
    $('#diag_id').val(id);
    $('#diag_icd_10').val(icd10);
    $('#diag_gdrg').val(gdrg);
    $('#diag_fee').val(fee);
    
    // Update hidden fields
    $('#diag_id').trigger('change');
    
    // Hide the results and clear any previous error messages
    $('#diagnosis_results').hide();
    $('.alert-container').empty();
});

// Handle diagnosis form submission
$('#add_diagnosis_form').submit(function(e) {
    e.preventDefault();
    
    // Clear previous error messages
    $('.alert-container').empty();
    
    // Validate that a diagnosis has been selected
    if (!$('#diag_id').val() || !$('#diagnosis_search').val()) {
        $('.alert-container').html(
            '<div class="alert alert-danger">Please select a diagnosis from the search results</div>'
        );
        return;
    }
    
    // Validate other required fields
    if (!$('#diag_type').val() || !$('#diag_category').val() || !$('#diag_principal').val()) {
        $('.alert-container').html(
            '<div class="alert alert-danger">Please fill in all required fields</div>'
        );
        return;
    }

    // Disable form submission button to prevent double submission
    const submitBtn = $(this).find('button[type="submit"]');
    const originalBtnText = submitBtn.html();
    submitBtn.prop('disabled', true).html('<i class="bx bx-loader bx-spin"></i> Adding...');
    
    $.ajax({
        url: '/add-diagnosis',
        method: 'POST',
        data: {
            opd_number: $('#diag_opdnumber').val(),
            consultation_id: $('#consultation_id').val(),
            episode_id: $('#episode_id').val(),
            patient_id: $('#diag_patient_id').val(),
            attendance_id: $('#diag_attendance_id').val(),
            diagnosis_id: $('#diag_id').val(),
            icd_10: $('#diag_icd_10').val(),
            diagnosis_type: $('#diag_type').val(),
            diag_fee: $('#diag_fee').val(),
            diag_gdrg: $('#diag_gdrg').val(),
            diagnosis_category: $('#diag_category').val(),
            diagnosis_principal: $('#diag_principal').val(),
            doctor_id: $('#doctors').val(),
            _token: $('input[name="_token"]').val()
        },
        success: function(response) {
            if (response.success) {
                // Show success message with toastr
                toastr.success('Diagnosis Added successfully');
                 submitBtn.prop('disabled', false).html('<i class="bx bx-plus"></i> Add');
                // Reset form
                $('#add_diagnosis_form')[0].reset();
                $('#diag_id').val('');
                $('#diag_icd_10').val('');
                $('#diag_gdrg').val('');
                $('#diag_fee').val('');
                refreshDiagnosisTable();
            } else {
                toastr.error(response.message || 'Error adding diagnosis');
            }
        },
        error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'Error saving diagnosis');
        }
    });
});


// Handle diagnosis deletion
$(document).on('click', '.delete-diagnosis', function() {
    const diagnosis_id = $(this).data('id');
    
    Swal.fire({
        title: 'Delete Diagnosis',
        text: 'Are you sure you want to delete this diagnosis?',
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
                url: '/delete-diagnosis/' + diagnosis_id,
                method: 'DELETE',
                data: {
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('Diagnosis deleted successfully');
                        refreshDiagnosisTable();
                    } else {
                        toastr.error('Failed to delete diagnosis');
                    }
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.message || 'Error deleting diagnosis';
                    toastr.error(errorMsg);
                },
                complete: function() {
                    deleteBtn.html(originalHtml).prop('disabled', false);
                }
            });
        }
    });
});

// Initialize the diagnosis table on page load
refreshDiagnosisTable();
// ********************************************** END DIAGNOSIS ***********************************************************************

// ********************************************** START PRESCRIPTIONS ***********************************************************************
// PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE PRESCRIPTION SIDE 

// Initialize prescription search with custom dropdown
let prescriptionSearchTimeout;
let prescriptionResultsDiv = $('<div id="prescription_results" class="prescription-results"></div>')
    .insertAfter('#prescription_search')
    .hide()
    .css({
        'position': 'absolute',
        'z-index': '1000',
        'background': 'white',
        'border': '2px solid #ddd',
        'max-height': '200px',
        'overflow-y': 'auto',
        'width': '90%'
    });

$('#prescription_search').on('input', function() {
    let searchTerm = $(this).val().trim();
    clearTimeout(prescriptionSearchTimeout);

    if (searchTerm.length < 2) {
        prescriptionResultsDiv.hide();
        return;
    }

    prescriptionSearchTimeout = setTimeout(function() {
        $.ajax({
            url: '/api/medication/search',
            method: 'POST',
            data: { 
                prescription_query: searchTerm,
                patient_id: $('#prescription_patient_id').val(),
                opd_number: $('#prescription_opdnumber').val(),
                _token: $('input[name="_token"]').val()
            },
            beforeSend: function() {
                prescriptionResultsDiv.html('<div class="p-2 text-center">Searching medications...</div>').show();
            },
            success: function(data) {
                if (data.length === 0) {
                    prescriptionResultsDiv.html('<div class="p-2 text-center">No medications found</div>');
                    return;
                }
                
                let results = data.map(function(item) {
                    return `<div class="prescription-item p-2 cursor-pointer hover:bg-gray-100" 
                                data-id="${item.product_id}" 
                                data-name="${item.product_name}"
                                data-dosage="${item.pres_quanity_per_issue_unit || ''}"
                                data-price="${item.cash_price || 0}"
                                data-presentation="${item.presentation || ''}">
                                <div class="font-semibold">${item.product_name}</div>
                                <div class="text-sm text-muted">${item.presentation || ''} | Dosage: ${item.pres_quanity_per_issue_unit || 'N/A'} | Stock Level: ${item.stock_level || 'N/A'}</div>
                            </div>`;
                }).join('');
                
                prescriptionResultsDiv.html(results).show();
            },
            error: function() {
                prescriptionResultsDiv.html('<div class="p-2 text-center text-red-600">Error fetching results</div>');
            }
        });
    }, 300);
});

// Handle click outside to close results
$(document).on('click', function(e) {
    if (!$(e.target).closest('#prescription_search, #prescription_results').length) {
        prescriptionResultsDiv.hide();
    }
});

// Handle prescription selection
$(document).on('click', '.prescription-item', function() {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const dosage = $(this).data('dosage');
    const price = $(this).data('price');
    const presentation = $(this).data('presentation');
    
    $('#prescription_search').val(name);
    $('#prescription_product_id').val(id);
    $('#prescription_dosage').val(dosage);
    $('#prescription_price').val(price);
    $('#prescription_presentation').val(presentation);
    
    prescriptionResultsDiv.hide();
});

// Form submission
$('#add_prescription_form').on('submit', function(e) {
    e.preventDefault();
    
    // Clear previous error messages
    $('.alert-container').empty();
    
    // Validate required fields
    if (!$('#prescription_product_id').val() || !$('#prescription_search').val()) {
        $('.alert-container').html(
            '<div class="alert alert-danger">Please select a medication from the search results</div>'
        );
        return;
    }
    
    if (!$('#prescription_dosage').val() || !$('#prescription_quantity').val() || !$('#prescription_duration').val()) {
        $('.alert-container').html(
            '<div class="alert alert-danger">Please fill in all required fields</div>'
        );
        return;
    }

    // Disable form submission button to prevent double submission
    const submitBtn = $(this).find('button[type="submit"]');
    const originalBtnText = submitBtn.html();
    submitBtn.prop('disabled', true).html('<i class="bx bx-loader bx-spin"></i> Saving...');
    
    $.ajax({
        url: '/api/medication/save',
        method: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                toastr.success('Prescription saved successfully!');
                submitBtn.prop('disabled', false).html(originalBtnText);
                $('#add_prescription_form')[0].reset();
                $('#prescription_product_id').val('');
                // Optionally refresh prescriptions list if you have one
            } else {
                toastr.error(response.message || 'Error saving prescription');
                submitBtn.prop('disabled', false).html(originalBtnText);
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON?.message || 'Error saving prescription. Please try again.';
            toastr.error(errorMsg);
            submitBtn.prop('disabled', false).html(originalBtnText);
        }
    });
});


// Calculate end date when duration changes
    $('#prescription_duration').on('change', function() {
        let startDate = new Date($('#prescription_start_date').val());
        let duration = parseInt($(this).val());
        
        if (!isNaN(duration) && startDate instanceof Date && !isNaN(startDate)) {
            let endDate = new Date(startDate);
            endDate.setDate(startDate.getDate() + duration);
            $('#prescription_end_date').val(endDate.toISOString().split('T')[0]);
        }
    });
