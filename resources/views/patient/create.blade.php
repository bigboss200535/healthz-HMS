<x-app-layout>
<style>
 .form-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    display: none;
} 

.form-control.is-invalid {
    border-color: #dc3545;
    padding-right: calc(1.5em + 0.75rem);
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right calc(0.375em + 0.1875rem) center;
    background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
}

.invalid-feedback {
    display: none;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875em;
    color: #dc3545;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">    
          <h4 class="py-3 mb-4">
                <span class="text-muted fw-light">Patients /</span> Register Patient
            </h4>
            <div class="row">
            <!-- First column-->
            <div class="col-12 col-lg-8">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-tile mb-0"><b>Bio-information</b></h5>
                  </div>
                  <div class="card-body">
                    <form  enctype="multipart/form-data" method="post" id="patient_info" action="javascript:void(0);">
                    @csrf
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <meta name="csrf-token" content="{{ csrf_token() }}">

                    <div class="row mb-3">
                    <input type="text" class="form-control" id="pat_id" name="pat_id" hidden>
                      <div class="col">
                        <label class="form-label" for="title">Title <a style="color: red;">*</a></label>
                        <select name="title" id="title" class="form-control">
                          <option disabled selected>-Select-</option>
                              @foreach($title as $patient_title)                                        
                                <option value="{{ $patient_title->title }}">{{ strtoupper($patient_title->title) }}</option>
                              @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="firstname">Firstname <a style="color: red;">*</a></label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="eg. JOHN" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="middlename">Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="eg. O" autocomplete="off">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="lastname">Lastname <a style="color: red;">*</a></label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="eg. DOE">
                      </div>
                      <div class="col">
                        <label class="form-label" for="birth_date">Date of Birth <a style="color: red;">*</a></label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" autocomplete="off" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="gender_id">Gender <a style="color: red;">*</a></label>
                        <select name="gender_id" id="gender_id" class="form-control" wire:model="gender">
                          <option value="" disabled selected>-Select-</option>
                            @foreach($gender as $patient_gender)                                        
                              <option value="{{ $patient_gender->gender_id }}">{{ strtoupper($patient_gender->gender) }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="occupation">Occupation <a style="color: red;">*</a></label>
                        <select name="occupation" id="occupation" class="form-control">
                          <option disabled selected>-Select-</option>
                          @foreach($occupations as $works)                                        
                              <option value="{{ $works->occupation_id }}">{{ $works->occupation }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="education">Education <a style="color: red;">*</a></label>
                        <select name="education" id="education" class="form-control">
                          <option disabled selected>-Select-</option>
                          <option value="None">None</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="religion">Religion <a style="color: red;">*</a></label>
                        <select name="religion" id="religion" class="form-control">
                          <option value="" disabled selected>-Select-</option>
                          @foreach($religion as $u_u)                                        
                            <option value="{{ $u_u->religion_id }}">{{ strtoupper($u_u->religion) }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="nationality">Nationality <a style="color: red;">*</a></label>
                        <select name="nationality" id="nationality" class="form-control">
                          <option disabled selected>-Select-</option>
                          <option value="10001">GHANAIAN</option>
                          <option value="20001">NON-GHANAIAN</option>
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="ghana_card">Ghana Card Number</label>
                        <input type="text" class="form-control" id="ghana_card" name="ghana_card" data-inputmask="'mask': 'AAA-99999999-9'"  placeholder="GH-0000000-x" autocomplete="off">
                      </div>
                    </div>
                    <div class="row mb 3">
                        <h5 class="card-tile mb-0"><b>Contact Information</b></h5>
                    </div>
                    <br>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="telephone">Telephone</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" placeholder="02XXXXXXX" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="work_telephone">Work Telephone</label>
                        <input type="text" class="form-control" id="work_telephone" name="work_telephone" placeholder="0xxxxxxxxx" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com" autocomplete="off">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="address">Home Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="town">Town</label>
                        <select name="town" id="town" class="select2 form-control region_select">
                          <option value="" disabled selected>-Select-</option>
                            @foreach($towns as $town)                                        
                              <option value="{{ $town->towns }}">{{ strtoupper($town->towns) }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="region">Region</label>
                        <select name="region" id="region" class="select2 form-control region_select">
                          <option value="" disabled selected>-Select-</option>
                          @foreach($region as $regions)                                        
                            <option value="{{ $regions->region_id }}">{{ strtoupper($regions->region) }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <br>
                    <div class="row mb 3">
                          <h5 class="card-tile mb-0"><b>Emergency Contact</b></h5>
                    </div>
                    <br>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="contact_person">Fullname</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="eg. JANE DOE">
                      </div>
                      <div class="col">
                        <label class="form-label" for="contact_relationship">Relationship</label>
                        <select name="contact_relationship" id="contact_relationship" class="form-control">
                          <option disabled selected>-Select-</option>
                          @foreach($relation as $rel)                                        
                            <option value="{{ $rel->relation_id }}">{{ strtoupper($rel->relation) }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="contact_telephone">Telephone</label>
                        <input type="text" class="form-control" id="contact_telephone" name="contact_telephone" placeholder="0xxxxxxxxx" autocomplete="off">
                      </div>
                    </div>
                    <div class="row mb 3">
                          <h5 class="card-tile mb-0"><b>Clinic #</b></h5>
                    </div>
                    <br>
                    <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="opd_type">OPD # Type</label>
                        <select name="opd_type" id="opd_type" class="form-control">
                          <option value="" selected disabled>-Select OPD #-</option>
                          <option value="1" selected>NEW</option>
                          <option value="0">OLD</option>
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="folder_clinic">Clinic</label>
                        <select name="folder_clinic" id="folder_clinic" class="form-control">
                          <option value="" selected disabled>-Select Clinic-</option>
                          @foreach($clinic_attendance as $clinics)                                        
                            <option value="{{ $clinics->service_point_id }}">{{ $clinics->service_points }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="opd_number">OPD #</label>
                        <input type="text" class="form-control" id="opd_number" name="opd_number">
                      </div>
                    </div>
                    <!-- <div class="row mb 3">
                          <h5 class="card-tile mb-0">Emergency Contact</h5>
                    </div> -->
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-4">
                <div class="card mb-4">
                  <div class="card-body">
                    <div class="row mb 3">
                          <h5 class="card-tile mb-0"><b>Sponsorship Type</b></h5>
                    </div>
                    <br>
                  <div class="mb-3 col ecommerce-select2-dropdown">
                      <label class="form-label mb-1" for="sponsor_type_id">Sponsor Type</label>
                      <select name="sponsor_type_id" id="sponsor_type_id" class="select2 form-control sponsor_type_id">
                        <option disabled selected>-Select-</option>
                          @foreach($payment_type as $sponsor_type)                                        
                            <option value="{{ $sponsor_type->sponsor_type_id }}">{{ strtoupper($sponsor_type->sponsor_type) }}</option>
                          @endforeach
                      </select>
                    </div>
                    <div class="row mb 3 sponsorship_details_settings" >
                          <h5 class="card-tile mb-0"><b>Sponsorship Details</b></h5>
                    </div>
                    <br>
                    <div class="mb-3 col ecommerce-select2-dropdown sponsorship_details_settings" >
                      <label class="form-label mb-1" for="sponsor_id">Sponsor Name </label>
                      <select id="sponsor_id" name="sponsor_id" class="select2 form-select sponsor_name">
                        <option value="" disabled selected>-Select-</option>
                      </select>
                    </div>
                    <div class="mb-3 col ecommerce-select2-dropdown sponsorship_details_settings">
                      <label class="form-label mb-1" for="member_no">Membership Number</label>
                      <input type="text" name="member_no" id="member_no" class="form-control" >
                    </div>
                    <div class="mb-3 col ecommerce-select2-dropdown sponsorship_details_settings">
                      <label class="form-label mb-1" for="dependant">Dependant</label>
                      <select class="form-control" class="form-control" id="dependant" name="dependant">
                        <option value="NO" selected>NO</option>
                        <option value="YES">YES</option>
                      </select>
                    </div>
                    <div class="mb-3 col ecommerce-select2-dropdown sponsorship_details_settings">
                      <label class="form-label mb-1 d-flex justify-content-between align-items-center" for="start_date">
                        <span>Start Date</span></label>
                      <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="mb-3 col ecommerce-select2-dropdown sponsorship_details_settings">
                      <label class="form-label mb-1 d-flex justify-content-between align-items-center" for="end_date">
                        <span>End Date</span></label>
                      <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="mb-3 col ecommerce-select2-dropdown sponsorship_details_settings">
                      <label class="form-label mb-1 d-flex justify-content-between align-items-center" for="card_status">
                        <span>Sponsor Status</span></label>
                      <input type="text" name="card_status" id="card_status" class="form-control" readonly>
                    </div>
                  </div>
                </div>
              </div>
              <div class="d-flex align-content-center flex-wrap gap-3">
                <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save Patient</button>
                <!-- <button type="reset" class="btn btn-info"> <i class="bx bx-reset"></i> Clear Form</button> -->
                <!-- <a href="{{ route('patients.index') }}" class="btn btn-dark"> <i class="bx bx-search"></i> Search Patient</a> -->
              </div>
            </form>
            </div>
          </div>
          </div>   
<!-- <script>
  $(document).ready(function() {
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

    // Handle form submission
    // Add real-time validation for required fields and format validation
    $('select[required], input[required]').on('change blur', function() {
        const field = $(this);
        if (!field.val()) {
            field.addClass('is-invalid');
            if (!field.next('.invalid-feedback').length) {
                field.after(`<div class="invalid-feedback">This field is required</div>`);
            }
        } else {
            field.removeClass('is-invalid');
            field.next('.invalid-feedback').remove();
        }
    });

    // Phone number validation
    $('input[id$="telephone"]').on('input blur', function() {
        const field = $(this);
        const phoneRegex = /^0[0-9]{9}$/;
        if (field.val() && !phoneRegex.test(field.val())) {
            field.addClass('is-invalid');
            if (!field.next('.invalid-feedback').length) {
                field.after(`<div class="invalid-feedback">Please enter a valid 10-digit phone number starting with 0</div>`);
            }
        } else {
            field.removeClass('is-invalid');
            field.next('.invalid-feedback').remove();
        }
    });

    // Email validation
    $('#email').on('input blur', function() {
        const field = $(this);
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (field.val() && !emailRegex.test(field.val())) {
            field.addClass('is-invalid');
            if (!field.next('.invalid-feedback').length) {
                field.after(`<div class="invalid-feedback">Please enter a valid email address</div>`);
            }
        } else {
            field.removeClass('is-invalid');
            field.next('.invalid-feedback').remove();
        }
    });
});
</script> -->
<!-- <script>
$(document).ready(function() {
    // Handle form submission
    $('#patient_info').on('submit', function(e) {
        e.preventDefault();
        const $form = $('#patient_info');

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
            { field: 'firstname', value: patient_save.firstname, message: 'First name must be at least 3 characters long', condition: patient_save.firstname && patient_save.firstname.length < 3 },
            { field: 'lastname', value: patient_save.lastname, message: 'Lastname cannot be empty', condition: !patient_save.lastname },
            { field: 'lastname', value: patient_save.lastname, message: 'Lastname must be at least 3 characters long', condition: patient_save.lastname && patient_save.lastname.length < 3 },
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
            { field: 'region', value: patient_save.region, message: 'Please select region', condition: !patient_save.region || patient_save.region === "-Select-" },
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
                toastr.warning('Please select a sponsor');
                $('#sponsor_id').addClass('is-invalid').focus();
                return;
            }
            if (!patient_save.member_no) {
                toastr.warning('Please enter member number');
                $('#member_no').addClass('is-invalid').focus();
                return;
            }
            if (!patient_save.start_date) {
                toastr.warning('Please enter start date');
                $('#start_date').addClass('is-invalid').focus();
                return;
            }
            if (!patient_save.end_date) {
                toastr.warning('Please enter end date');
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
                toastr.warning(rule.message);
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
  });
</script> -->
</x-app-layout>