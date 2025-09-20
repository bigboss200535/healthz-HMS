<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">   
         <h4 class="py-3 mb-4">
              <span class="text-muted fw-light">Users /</span> User Profile
          </h4> 
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        </div>
  <div class="row">
   <div class="col-12 col-lg-8">
    <div class="nav-align-top nav-tabs-shadow mb-6">
      <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#nav_home" aria-controls="navs-justified-home" aria-selected="true">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i> 
              User Infomation
            </span>
            <i class="bx bx-home bx-sm d-sm-none"></i>
          </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_sponsor" aria-controls="navs-justified-profile" aria-selected="false">
              <span class="d-none d-sm-block">
                <i class="tf-icons bx bx-money-withdraw bx-sm me-1_5 align-text-bottom"></i> 
                User Logs
              </span>
              <i class="bx bx-user bx-sm d-sm-none"></i>
            </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_attendance" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-timer bx-sm me-1_5 align-text-bottom"></i> Activity History
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li>
        <!-- <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_medications" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-time bx-sm me-1_5 align-text-bottom"></i> Appointments
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li> -->
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="nav_home" role="tabpanel">
          <p>
              <!-- <div class="card-header">
                  <h5 class="card-tile mb-0 text-primary"><b>BIO-INFORMATION</b></h5>
              </div> -->
                <table class="table">
                    <tr>
                       <td colspan="2">
                          <h5 class="text-dark"><b>BIO-INFORMATION</b></h5>
                       </td>
                    </tr>
                    <tr>
                      <td><b>Fullname</b></td>
                      <td>{{ strtoupper($user->user_fullname) }}</td>
                    </tr>
                    <tr>
                      <td><b>Gender</b></td>
                      <td>{{ strtoupper($user->gender) }}</td>
                    </tr>
                    <tr>
                      <td><b>Access Level</b></td>
                      <td>{{ strtoupper($user->role_type) }}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Email Verified</b></td>
                        <td>{{ $user->email_verified }}</td>
                    </tr>
                    <tr>
                        <td><b>Telephone</b></td>
                        <td>{{ $user->telephone }}</td>
                    </tr>
                    <tr>
                      <td><b>Date Registered</b>:</td>
                      <td>{{ \Carbon\Carbon::parse($user->added_date)->format('d-m-Y') }}</td>
                    </tr>
                      
                    </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_sponsor" role="tabpanel">
          <p>
            <div>
              <h5>User Logs</h5>
                <!-- <div class="pull-right">
                    <a href="#" class="btn btn-info pull-right" id="clear_search">Add Sponsor</a>
                </div> -->
            </div>
            <table class="table table-hover" id="patient_sponsor">
              <thead>
                <tr>
                  <th>Sponsor Type</th>
                  <th>Member #</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Sponsorhip Status</th>
                  <th>Prority Sponsor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                     
              </tbody>
              <tfoot>
                <tr>
                <th>Sponsor Type</th>
                  <th>Member #</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Sponsorhip Status</th>
                  <th>Prority Sponsor</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_attendance" role="tabpanel">
        <p>
            <div>
              <h5>Activity History</h5>
            </div>
            <table class="table table-hover" id="attendance_details">
              <thead>
                <tr>
                  <th>Sn #</th>
                  <th>Attendance Date</th>
                  <th>Patient Age</th>
                  <th>Clinic</th>
                  <th>Sponsor</th>
                  <th>Status</th>
                  <!-- <th>is NHIS</th> -->
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                            
             </tbody>
              <tfoot>
                <tr>
                  <th>Sn #</th>
                  <th>Attendance Date</th>
                  <th>Patient Age</th>
                  <th>Clinic</th>
                  <th>Sponsor</th>
                  <th>Status</th>
                  <!-- <th>is NHIS</th> -->
                  <th>Status</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
        <!-- <div class="tab-pane fade" id="nav_medications" role="tabpanel">
        <p>
            <div>
              <h5>Appointments History</h5>
            </div>
            <table class="table table-hover" id="appointments">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div> -->
       
        
       
      </div>
    </div>
    <!-- <button type="button" class="btn btn btn-info">CHANGE PASSWORD</button>
                        <button type="button" class="btn btn btn-warning">EDIT DETAILS</button> -->
  </div>
  
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb 3">
              
          </div>
           <div class="mb-3 col ecommerce-select2-dropdown" align="center">
            <img src="{{ $user->gender==='FEMALE' ? asset('img/avatars/female.jpg') : asset('img/avatars/male.jpg') }}" alt="Patient Image" class="rounded-pill" style="border:1px;border-color:black; box-shadow:10px ">
          </div>
          <div class="mb-3 col ecommerce-select2-dropdown" align="center">
            <h5 class="card-tile mb-0"><b> {{ $user->fullname }}</b></h5>
          </div>
          <div class="mb-3 col ecommerce-select2-dropdown">
           <table class="table">
            <tr>
              <td colspan="2" align="center">
                 <h5 class="text-dark"> {{ strtoupper($user->user_fullname) }}</h5>
                  <h6>{{ strtoupper($user->role_type) }}</h6>    
              </td>
            </tr>
            <tr>
              <td colspan="2" align="center">
                    <button type="button" data-bs-toggle='modal' data-bs-target="#update_user_password" class="btn btn btn-primary">Change Password</button>
                    <button type="button" data-bs-toggle='modal' data-bs-target="#edit_user_details" class="btn btn btn-warning">Edit Details</button>
              </td>
            </tr>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
</div>   

<!--update password Modal -->
<div class="modal fade" id="update_user_password" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-simple">
    <div class="modal-content">
      <div class="modal-body">
        <div class="text-center mb-6">
          <h4 class="address-title mb-2">User Password Update</h4>
           <p class="subtitle">Change your user password</p>
        </div>
          <!-- <div class="alert-container"></div> -->
        <form id="update_password_form" action="{{ route('profile.password_update') }}" method="POST" class="row g-6">
          @csrf
          <!-- <div id="user_success_diplay" class="container mt-6"></div> -->
           <div id="user_success_display" class="alert d-none"></div>

          <div class="col-12 col-md-12">
            <label class="form-label" for="old_password">Old Password</label>
            <input type="password" id="old_password" name="old_password" class="form-control" min="8" placeholder="**********"/>
          </div>

          <div class="col-12 col-md-12">
            <label class="form-label" for="new_password">New Password</label>
            <input type="password" id="new_password" name="new_password" class="form-control" min="8" placeholder="**********"/>
          </div>

          <div class="col-12 col-md-12">
            <label class="form-label" for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" class="form-control" min="8" placeholder="**********"/>
          </div>

          <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary me-3" id="service_request_save" name="service_request_save">Submit</button>
            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" id="reset_close"><i class="bx bx-times"></i>Close</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
 <!------------------------------------------****************************----------------------------------------------------->
 <script>
$(document).ready(function () {
    // Attach submit event to the form
    $('#update_password_form').on('submit', function (e) {
        e.preventDefault();

        let form = $(this);
        let submitBtn = form.find('button[type="submit"]');

        // Clear previous errors & messages
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $('#user_success_display').removeClass('alert alert-success').empty();

        // Disable submit button while processing
        submitBtn.prop('disabled', true).text('Processing...');

        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF
            },
            success: function (response) {
                // Show success message
                $('#user_success_display')
                    .addClass('alert alert-success')
                    .text(response.message)
                    .fadeIn();

                // Clear form fields
                form.trigger('reset');

                // Close modal after 4 seconds
                setTimeout(function () {
                    $('#update_user_password').modal('hide');
                    $('#user_success_display').fadeOut();
                }, 4000);
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        let input = form.find(`[name="${field}"]`);
                        input.addClass('is-invalid');
                        input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
                    });
                } else {
                    // General error handling
                    $('#user_success_display')
                        .addClass('alert alert-danger')
                        .text('Something went wrong. Please try again later.')
                        .fadeIn();
                }
            },
            complete: function () {
                // Re-enable submit button
                submitBtn.prop('disabled', false).text('Submit');
            }
        });
    });

    // Optional: Reset form when modal is closed
    $('#update_user_password').on('hidden.bs.modal', function () {
        $('#update_password_form').trigger('reset');
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        $('#user_success_display').removeClass('alert alert-success alert-danger').empty();
    });
});
</script>

</x-app-layout>