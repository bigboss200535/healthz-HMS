// // Diagnosis search and management functionality
// $(document).ready(function() {
//     // Initialize diagnosis search with autocomplete
//     $('#diagnosis_search').autocomplete({
//         source: function(request, response) {
//             $.ajax({
//                 url: '/api/search-diagnosis',
//                 method: 'GET',
//                 data: { 
//                     query: request.term, 
//                     patient_id: $('#diag_patient_id').val() 
//                 },
//                 success: function(data) {
//                     // Create a div to show search results if not already exists
//                     if ($('#diagnosis_results').length === 0) {
//                         $('<div id="diagnosis_results"></div>').insertAfter('#diagnosis_search');
//                     }
                    
//                     // Display results in a more user-friendly format
//                     let results = '';
//                     data.forEach(function(item) {
//                         results += `<div class="diagnosis-item" 
//                                         data-id="${item.diagnosis_id}" 
//                                         data-name="${item.diagnosis_name}"
//                                         data-icd10="${item.icd10_code || ''}"
//                                         data-gdrg="${item.gdrg_code || ''}"
//                                         data-fee="${item.fee || 0}">
//                                         ${item.diagnosis_name} (${item.icd10_code || 'No ICD-10'})
//                                     </div>`;
//                     });
                    
//                     $('#diagnosis_results').html(results);
                    
//                     // Standard autocomplete response
//                     response(data.map(function(item) {
//                         return {
//                             label: item.diagnosis_name + ' (' + (item.icd10_code || 'No ICD-10') + ')',
//                             value: item.diagnosis_name,
//                             id: item.diagnosis_id,
//                             icd10: item.icd10_code || '',
//                             gdrg: item.gdrg_code || '',
//                             fee: item.fee || 0
//                         };
//                     }));
//                 }
//             });
//         },
//         minLength: 2,
//         select: function(event, ui) {
//             $('#diag_id').val(ui.item.id);
//             $('#diag_icd_10').val(ui.item.icd10);
//             $('#diag_gdrg').val(ui.item.gdrg);
//             $('#diag_fee').val(ui.item.fee);
//             return true;
//         }
//     });
    
//     // Handle clicking on diagnosis items in the results div
//     $(document).on('click', '.diagnosis-item', function() {
//         const id = $(this).data('id');
//         const name = $(this).data('name');
//         const icd10 = $(this).data('icd10');
//         const gdrg = $(this).data('gdrg');
//         const fee = $(this).data('fee');
        
//         $('#diagnosis_search').val(name);
//         $('#diag_id').val(id);
//         $('#diag_icd_10').val(icd10);
//         $('#diag_gdrg').val(gdrg);
//         $('#diag_fee').val(fee);
        
//         // Hide the results after selection
//         $('#diagnosis_results').hide();
//     });

//     // Handle diagnosis form submission
//     $('#add_diagnosis_form').submit(function(e) {
//         e.preventDefault();
        
//         // Validate that a diagnosis has been selected
//         if (!$('#diag_id').val()) {
//             $('.alert-container').html(
//                 '<div class="alert alert-danger">Please select a diagnosis from the search results</div>'
//             );
//             return;
//         }
        
//         $.ajax({
//             url: '/api/save-diagnosis',
//             method: 'POST',
//             data: {
//                 opd_number: $('#diag_opdnumber').val(),
//                 patient_id: $('#diag_patient_id').val(),
//                 diagnosis_id: $('#diag_id').val(),
//                 diagnosis_type: $('#diag_type').val(),
//                 diagnosis_category: $('#diag_category').val(),
//                 diagnosis_principal: $('#diag_principal').val(),
//                 _token: $('input[name="_token"]').val()
//             },
//             success: function(response) {
//                 if (response.success) {
//                     // Show success message
//                     $('.alert-container').html(
//                         '<div class="alert alert-success">Diagnosis added successfully</div>'
//                     );
                    
//                     // Refresh diagnosis table
//                     refreshDiagnosisTable();
                    
//                     // Reset form
//                     $('#add_diagnosis_form')[0].reset();
//                     $('#diag_id').val('');
//                     $('#diag_icd_10').val('');
//                     $('#diag_gdrg').val('');
//                     $('#diag_fee').val('');
                    
//                     // Close modal after delay
//                     setTimeout(function() {
//                         $('#add_diagnosis').modal('hide');
//                         $('.alert-container').html('');
//                     }, 2000);
//                 }
//             },
//             error: function(xhr) {
//                 $('.alert-container').html(
//                     '<div class="alert alert-danger">Error saving diagnosis: ' + 
//                     (xhr.responseJSON?.message || 'Unknown error') + '</div>'
//                 );
//             }
//         });
//     });

//     // Function to refresh diagnosis table
//     function refreshDiagnosisTable() {
//         $.ajax({
//             url: '/api/get-diagnosis/' + $('#diag_patient_id').val(),
//             method: 'GET',
//             success: function(data) {
//                 let tableBody = '';
//                 if (data.length === 0) {
//                     tableBody = '<tr><td colspan="5" class="text-center">No diagnoses found</td></tr>';
//                 } else {
//                     data.forEach(function(item, index) {
//                         tableBody += `
//                             <tr>
//                                 <td>${index + 1}</td>
//                                 <td>${item.diagnosis_name}</td>
//                                 <td>${item.icd10_code || ''}</td>
//                                 <td>${item.gdrg_code || ''}</td>
//                                 <td>
//                                     <button class="btn btn-sm btn-danger delete-diagnosis" data-id="${item.id}">
//                                         <i class="bx bx-trash"></i>
//                                     </button>
//                                     <button class="btn btn-sm btn-primary edit-diagnosis" data-id="${item.id}">
//                                         <i class="bx bx-edit"></i>
//                                     </button>
//                                 </td>
//                             </tr>
//                         `;
//                     });
//                 }
                
//                 // Make sure the table has a tbody element
//                 if ($('#diagnosis tbody').length === 0) {
//                     $('#diagnosis').append('<tbody></tbody>');
//                 }
                
//                 $('#diagnosis tbody').html(tableBody);
//             },
//             error: function() {
//                 $('#diagnosis tbody').html('<tr><td colspan="5" class="text-center">Error loading diagnoses</td></tr>');
//             }
//         });
//     }

//     // Handle diagnosis deletion
//     $(document).on('click', '.delete-diagnosis', function() {
//         if (confirm('Are you sure you want to delete this diagnosis?')) {
//             const diagnosisId = $(this).data('id');
//             $.ajax({
//                 url: '/api/delete-diagnosis/' + diagnosisId,
//                 method: 'DELETE',
//                 data: {
//                     _token: $('input[name="_token"]').val()
//                 },
//                 success: function(response) {
//                     if (response.success) {
//                         refreshDiagnosisTable();
//                     }
//                 },
//                 error: function() {
//                     alert('Error deleting diagnosis');
//                 }
//             });
//         }
//     });

//     // Initialize the diagnosis table on page load
//     refreshDiagnosisTable();
// });