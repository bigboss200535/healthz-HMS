<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="description" content=""/>
     <meta name="theme-color" content="#06c1db"/>
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
    <script src="{{ asset('js/diagnosis_and_drugs.js') }}"></script>
     <script src="{{ asset('js/patient_registration.js') }}"></script>
    <script src="{{ asset('js/consultation.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js') }}"></script>
    <!-- <script src="{{ asset('js/fullcalendar.js') }}"></script> -->
    <!-- <script src="{{ asset('js/app-calendar-events.js') }}"></script> -->
    <!-- <script src="{{ asset('js/app-calendar.js') }}"></script> -->
<!-- <script>
  $(document).ready(function() {
    $('#consulting_room, #consulting_type, #consulting_doctors, #consulting_date, #consulting_episode').change(function() {
        if ($('#consulting_room').val() && $('#consulting_type').val() && $('#consulting_doctors').val() && $('#consulting_date').val() && $('#consulting_episode').val()) 
        {
            $('#consultation_display').show();
            $('#required_fields_message').hide();
            
        } else {
            $('#consultation_display').hide();
            $('#required_fields_message').show();
        }
    });
});
</script> -->
    <script type="text/javascript">
        $(document).ready( function () {
            $('#app_list').DataTable({
                searching: false
            });
            // $('#symptoms-table').DataTable();
            $('#system_table').DataTable();
            $('#attendance_details').DataTable();   
            $('#claims_code_list').DataTable();
            $('#prescriptions_list').DataTable(); 
            $('#patient_sponsor').DataTable();
            $('#service_request').DataTable();
            $('#appointments').DataTable();
            $('#diagnostics_list').DataTable();
            $('#patient_list').DataTable();
            $('#patient_services').DataTable();
            $('#patient_search_list').DataTable();
            $('#patient_searches').DataTable();
            $('#nurses_notes_patient').DataTable();
            $('#drugs').DataTable();
            $('#users_list').DataTable();
            $('#register_list').DataTable();
            $('.sponsor_name').select2();
            $('.diagnosis_search').select2();
            // $('.sponsor_type_id').select2();
            $('.select_2_dropbox').select2();

            $('#telephone, #work_telephone, #contact_telephone').inputmask({
                mask: '+233 999 999 9999',
                placeholder: ' ',
                showMaskOnHover: false,
                showMaskOnFocus: true
             });

        
             // *****************CHART FOR VITAL SIGNS****************************
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
             // *****************END CHART FOR VITAL SIGNS****************************

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
<!-- <script>
 
</script> -->
<script>

              $(document).ready(function() {
                  $('#user_form').submit(function(e) {
                      e.preventDefault();

                      const $submitBtn = $('#save_user');
                      const $clearBtn = $('#clear_user_form');
                      const $form = $('#user_form'); // Added missing form reference

                      const original_text = $submitBtn.html();
                      const formData = new FormData($form[0]);
                      const user_save = Object.fromEntries(formData.entries());

                      $clearBtn.prop('disabled', true);

                      // Clear previous validation errors
                      $('.is-invalid').removeClass('is-invalid');

                      if (!user_save.u_user_name || user_save.u_user_name === ""){
                          $('#u_user_name').addClass('is-invalid').focus();
                          return false;
                      }

                      if (!user_save.first_name || user_save.first_name === ""){
                          $('#first_name').addClass('is-invalid').focus();
                          return false;
                      }

                      if (!user_save.other_name || user_save.other_name === ""){
                          $('#other_name').addClass('is-invalid').focus();
                          return false;
                      }
                      
                      if (!user_save.u_pass_word || user_save.u_pass_word === ""){
                          $('#u_pass_word').addClass('is-invalid').focus();
                          return false;
                      }

                      if (!user_save.confirm_pass || user_save.confirm_pass === ""){
                          $('#confirm_pass').addClass('is-invalid').focus();
                          return false;
                      }

                      if (!user_save.gender || user_save.gender === ""){
                          $('#gender').addClass('is-invalid').focus();
                          return false;
                      }

                      if (!user_save.user_role || user_save.user_role === ""){
                          $('#user_role').addClass('is-invalid').focus();
                          return false;
                      }

                      // Validate password match
                      if (user_save.u_pass_word !== user_save.confirm_pass) {
                          toastr.warning('Password and Confirm Password do not match');
                          $('#u_pass_word').addClass('is-invalid').focus();
                          $('#confirm_pass').addClass('is-invalid');
                          return false;
                      }

                      const url = user_save.user_id ? `/users/${user_save.user_id}` : '/users';
                      const method = user_save.user_id ? 'PUT' : 'POST'; // Fixed variable name from patient_save to user_save

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
                              $clearBtn.prop('disabled', true);
                              $submitBtn.prop('disabled', true)
                              .html('<span class="spinner-border spinner-border-sm" role="status"></span> Submitting...');
                          },
                          success: function(response) {
                              if(response.code === 201) {
                                  toastr.success('User created successfully');
                                  $submitBtn.prop('disabled', false);
                                  $clearBtn.prop('disabled', false);
                                  $form[0].reset(); // Reset form after successful submission
                                  
                                  // Reload the table section via AJAX
                                  reload_user_table();
                              } else if (response.code === 200) {
                                  toastr.warning('Ops! ' + response.message);
                                  $submitBtn.prop('disabled', false);
                                  $clearBtn.prop('disabled', false);
                              } 
                            //   else {
                            //       toastr.error(response.message || 'Error saving User');
                            //       $submitBtn.prop('disabled', false);
                            //       $clearBtn.prop('disabled', false);
                            //   }
                          },
                          error: function(xhr) {
                              let errors = xhr.responseJSON?.errors || {};
                              let errorMessage = '';
                              
                              $.each(errors, function(key, value) {
                                  errorMessage += value + '\n';
                                  $(`#${key}`).addClass('is-invalid');
                              });
                              toastr.error('Ops! ' + errorMessage);
                              $submitBtn.prop('disabled', false);
                              $clearBtn.prop('disabled', false);
                          },
                          complete: function () {
                            $submitBtn.prop('disabled', false).html('Submit');
                            $clearBtn.prop('disabled', false);
                          }
                      });
                  });

                  function reload_user_table() {
                        $.get(window.location.href, function(data) {
                            const newTable = $(data).find('#users_list').html();
                            $('#users_list').html(newTable);
                            
                            // Re-initialize any plugins if needed
                            // $('#users_list').DataTable();
                        }).fail(function() {
                            toastr.error('Could not refresh user list');
                        });
                    }
              });
</script>
<script>
$(document).ready(function() {
    // Handle main permission toggle (is_granted)
    $(document).on('change', 'table#app_list tbody tr td:first-child input[type="checkbox"]', function() {
        const checkbox = $(this);
        const isChecked = checkbox.is(':checked') ? 1 : 0;
        const row = checkbox.closest('tr');
        const permissionId = row.find('.dropdown-menu a.product_delete_btn[data-id]').attr('data-id');
        
        // If no permission ID found in the row, it's likely the first checkbox
        if (!permissionId) {
            console.error('Permission ID not found');
            return;
        }

        updatePermission(permissionId, { is_granted: isChecked });
    });

    // Handle specific permission toggles (read, create, delete, update)
    $(document).on('change', 'table#app_list tbody tr td:nth-child(4) input[type="checkbox"]', function() {
        // View/Read permission (4th column)
        const checkbox = $(this);
        const isChecked = checkbox.is(':checked') ? '1' : '0';
        const permissionId = getPermissionIdFromRow(checkbox);
        updatePermission(permissionId, { read: isChecked });
    });

    $(document).on('change', 'table#app_list tbody tr td:nth-child(5) input[type="checkbox"]', function() {
        // Add/Create permission (5th column)
        const checkbox = $(this);
        const isChecked = checkbox.is(':checked') ? '1' : '0';
        const permissionId = getPermissionIdFromRow(checkbox);
        updatePermission(permissionId, { create: isChecked });
    });

    $(document).on('change', 'table#app_list tbody tr td:nth-child(6) input[type="checkbox"]', function() {
        // Delete permission (6th column)
        const checkbox = $(this);
        const isChecked = checkbox.is(':checked') ? '1' : '0';
        const permissionId = getPermissionIdFromRow(checkbox);
        updatePermission(permissionId, { delete: isChecked });
    });

    $(document).on('change', 'table#app_list tbody tr td:nth-child(7) input[type="checkbox"]', function() {
        // Edit/Update permission (7th column)
        const checkbox = $(this);
        const isChecked = checkbox.is(':checked') ? '1' : '0';
        const permissionId = getPermissionIdFromRow(checkbox);
        updatePermission(permissionId, { update: isChecked });
    });

    // Helper function to get permission ID from a row
    function getPermissionIdFromRow(element) {
        const row = element.closest('tr');
        return row.find('.dropdown-menu a.product_delete_btn[data-id]').attr('data-id');
    }

    // Function to send AJAX request
    function updatePermission(permissionId, data) {
        $.ajax({
            url: '/permissions/' + permissionId,
            type: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                ...data
            },
            success: function(response) {
                // Optional: Show success message
                toastr.success('Permission updated successfully');
            },
            error: function(xhr) {
                // Revert checkbox on error
                checkbox.prop('checked', !isChecked);
                toastr.error('Error updating permission');
                console.error(xhr.responseText);
            }
        });
    }
});
</script>
</body>
</html>