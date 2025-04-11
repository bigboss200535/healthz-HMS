<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content=""/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} | Anywhere, Everywhere</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon2.svg') }}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fontawesome.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}"/> 
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/libs/@form-validation/form-validation.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-profile.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/libs/spinkit/spinkit.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/libs/apex-charts/apex-charts.css') }}"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/pickr-themes.css') }}" />
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/app-calendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/flatpickr.css') }}" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <link rel="stylesheet" href="{{ asset('preloader.css') }}"> -->
    </head>
 <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
            <!-- Menu -->
            @include('layouts.aside')
            <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                @include('layouts.topmenu')
                    <!-- Content wrapper -->
                    <div class="content-wrapper">
                            <!-- Content -->
                                {{ $slot }}
                             <!-- / Content -->
                              <!-- Footer -->
                             @include('layouts.footer')
                             @include('layouts.modal.forms')
                       <div class="content-backdrop fade"></div>
                    </div>
                    <!-- Content wrapper -->
            </div>
           <!-- / Layout page -->
      </div>
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('vendor/js/menu.js') }}"></script>
    <script src="{{ asset('vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('vendor/libs/@form-validation/auto-focus.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/dashboards-analytics.js') }}"></script>
    <script src="{{ asset('js/app-academy-dashboard.js') }}"></script>
    <script src="{{ asset('js/app-ecommerce-category-list.js') }}"></script>
    <script async defer src="https://buttons.github.io/buttons.js') }}"></script>
    <script src="{{ asset('vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>  
    <script src="{{ asset('js/custom_js.js') }}"></script>
    <script src="{{ asset('js/patient_services.js') }}"></script>
    <script src="{{ asset('js/patient_details.js') }}"></script>
    <script src="{{ asset('js/patient_extras.js') }}"></script>
    <!-- <script src="{{ asset('js/diagnosis.js') }}"></script> -->
     <script src="{{ asset('js/patient_registration.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
    <script src="{{ asset('js/fullcalendar.js') }}"></script>
    <script src="{{ asset('js/app-calendar-events.js') }}"></script>
    <script src="{{ asset('js/app-calendar.js') }}"></script>
    
  </body>
</html>
<script type="text/javascript">
     $(document).ready( function () {
        // $("#ghana_card").inputmask({"mask": "AAA-9999999-9"});
        // $('#ghana_card').mask('AAA-9999999-9');
        $('#app_list').DataTable();
        $('#attendance_details').DataTable();   
        $('#claims_code_list').DataTable();
        // $('#current_att').DataTable(); 
        $('#patient_sponsor').DataTable();
        $('#appointments').DataTable();
        $('#diagnostics_list').DataTable();
        $('#patient_list').DataTable();
        $('#patient_services').DataTable();
        $('#patient_search_list').DataTable();
        $('#patient_searches').DataTable();
        $('#nurses_notes_patient').DataTable();
        $('#drugs').DataTable();
        $('#diagnosis_list').DataTable();
        $('.sponsor_name').select2();
        $('.diagnosis_search').select2();
        // $('.sponsor_type_id').select2();
        $('.select_2_dropbox').select2();
    });
</script>
<script>
   // Diagnosis search and management functionality
$(document).ready(function() {


   // Function to refresh diagnosis table
   function refreshDiagnosisTable() {
        const loadingRow = '<tr><td colspan="5" class="text-center"><i class="bx bx-loader bx-spin me-2"></i>Loading diagnoses...</td></tr>';
        $('#diagnosis_list tbody').html(loadingRow);
        
        $.ajax({
            url: '/get-diagnosis/' + $('#diag_attendance_id').val(),
            method: 'GET',
            success: function(data) {
                let tableBody = '';
                if (data.length === 0) {
                    tableBody = '<tr><td colspan="5" class="text-center text-muted">No diagnoses found</td></tr>';
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
                const errorRow = '<tr><td colspan="5" class="text-center text-danger"><i class="bx bx-error-circle me-2"></i>Error loading diagnoses</td></tr>';
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
                url: '/search-diagnosis',
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
        const diagnosisId = $(this).data('id');
        
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
                    url: '/delete-diagnosis/' + diagnosisId,
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
});
</script>
<script>
    $(document).on('click', '.product_delete_btn', function() {
      var product_id = $(this).data('id');

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
            url: '/product/' + product_id,
            type: 'DELETE',
            data: {
              _token: '{{ csrf_token() }}',
              product_id: product_id
            },
            success: function(response) {
              var result = JSON.parse(response);
              if (result == 201) {
                $("#product_list").load(location.href + " #product_list");
                toastr.success('Data deleted successfully!');
              } else if (result == 200) {
                toastr.warning('Data is attached to stock or prices');
              }
            },
            error: function(xhr, status, error) {
              toastr.error('Error deleting item! Try again');
            }
          });
        }
      });
    });
 </script>
 <!-- <script>
    document.addEventListener('contextmenu', event => event.preventDefault());
    document.addEventListener('keydown', event => {
        if (event.ctrlKey && (event.key === 'p' || event.key === 's')) {
            event.preventDefault();
        }
    });
</script> -->
<script>
  const ctx = document.getElementById('vital_sign_chart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: 'Pressure',
        data: [12, 19, 3, 5, 2, 20],
        borderWidth: 3
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>