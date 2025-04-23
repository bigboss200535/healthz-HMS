<x-app-layout>
<style>
      .btn-submitting {
          position: relative;
          padding-left: 2.5rem;
      }
      .btn-submitting:before {
          content: "";
          position: absolute;
          left: 1rem;
          top: 50%;
          transform: translateY(-50%);
          width: 1rem;
          height: 1rem;
          border: 2px solid rgba(255,255,255,0.3);
          border-radius: 50%;
          border-top-color: #fff;
          animation: spin 1s ease-in-out infinite;
      }
      @keyframes spin {
          to { transform: translateY(-50%) rotate(360deg); }
      }

      .required-field::after {
          content: " *";
          color: red;
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
                    <h5 class="card-tile mb-0"><b>Bio-Information</b></h5>
                    <label style="color:red">All fields marked * are mandatory</label>
                  </div>
                  <div class="card-body">
                    <form id="patient_info_create" method="post" onsubmit="return false">
                    @csrf
                    <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
                      <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="row mb-3">
                    <input type="text" class="form-control" id="pat_id" name="pat_id" hidden>
                      <div class="col">
                        <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                        <select name="title" id="title" class="form-control">
                          <option disabled selected>-Select-</option>
                              @foreach($title as $patient_title)                                        
                                <option value="{{ $patient_title->title }}">{{ strtoupper($patient_title->title) }}</option>
                              @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="firstname">Firstname <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="eg. JOHN" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="middlename">Middlename</label>
                        <input type="text" class="form-control" id="middlename" name="middlename" placeholder="eg. O" autocomplete="off">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="lastname">Lastname <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="eg. DOE">
                      </div>
                      <div class="col">
                        <label class="form-label" for="birth_date">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" autocomplete="off">
                      </div>
                      <div class="col">
                        <label class="form-label" for="age">Age</label>
                        <input type="text" class="form-control" id="age" name="age" autocomplete="off" disabled>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="gender_id">Gender <span class="text-danger">*</span></label>
                        <select name="gender_id" id="gender_id" class="form-control" wire:model="gender">
                          <option value="" disabled selected>-Select-</option>
                            @foreach($gender as $patient_gender)                                        
                              <option value="{{ $patient_gender->gender_id }}">{{ strtoupper($patient_gender->gender) }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="occupation">Occupation <span class="text-danger">*</span></label>
                        <select name="occupation" id="occupation" class="form-control">
                          <option disabled selected>-Select-</option>
                          <option value="N/A">NONE</option>
                          @foreach($occupations as $works)                                        
                              <option value="{{ $works->occupation_id }}">{{ $works->occupation }}</option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="education">Education <span class="text-danger">*</span></label>
                        <select name="education" id="education" class="form-control">
                          <option disabled selected>-Select-</option>
                          <option value="NONE">NONE</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col">
                        <label class="form-label" for="religion">Religion <span class="text-danger">*</span></label>
                        <select name="religion" id="religion" class="form-control">
                          <option value="" disabled selected>-Select-</option>
                          @foreach($religion as $u_u)                                        
                            <option value="{{ $u_u->religion_id }}">{{ strtoupper($u_u->religion) }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="nationality">Nationality <span class="text-danger">*</span></label>
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
                        <label class="form-label" for="opd_type">OPD # Type <span class="text-danger">*</span></label>
                        <select name="opd_type" id="opd_type" class="form-control">
                          <!-- <option value="" selected disabled>-Select OPD #-</option> -->
                          <option value="1" selected>NEW</option>
                          <option value="0">OLD</option>
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="folder_clinic">Clinic <span class="text-danger">*</span></label>
                        <select name="folder_clinic" id="folder_clinic" class="form-control">
                          <option value="" selected disabled>-Select-</option>
                          @foreach($clinic_attendance as $clinics)                                        
                            <option value="{{ $clinics->service_point_id }}">{{ $clinics->service_points }}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="col">
                        <label class="form-label" for="opd_number">OPD # <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="opd_number" name="opd_number">
                      </div>
                    </div>
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
                <button type="submit"  name="save_patient_info" id="save_patient_info" class="btn btn-primary">
                  <i class="bx bx-save"></i> 
                  Save Patient
                </button>
                <button type="reset" class="btn btn-info"> <i class="bx bx-reset"></i> Clear Form</button>
                <!-- <a href="{{ route('patients.index') }}" class="btn btn-dark"> <i class="bx bx-search"></i> Search Patient</a> -->
              </div>
            </form>
            </div>
          </div>
          </div>   
<script>
  $(document).ready(function() {
   
  
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
</script>

</x-app-layout>