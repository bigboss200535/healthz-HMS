<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
       <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1 mt-3">Patient Registration</h4>
          <p class="text-muted">Add new patient to the system</p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
          <!-- <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdoal_form" >Search Patient</button> -->
          <!-- <button class="btn btn-primary">Go to Registered Patients</button> -->
          <a href="{{ route('patients.index') }}" class="btn btn-primary">Search Patient</a>
          <a href="#" class="btn btn-primary">Patient Sponsors</a>
          <!-- <button type="submit" class="btn btn-primary">Patient Sponsorship</button> -->
        </div>
      </div>
  <div class="row">
   <!-- First column-->
   <div class="col-12 col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-tile mb-0"><b>Bio-information</b></h5>
        </div>
        <div class="card-body">
          <form  enctype="multipart/form-data" method="post" id="patient_info">
           @csrf
          <div class="row mb-3">
          <input type="text" class="form-control" id="pat_id" name="pat_id" hidden>
            <div class="col">
              <label class="form-label" for="title">Title <a style="color: red;">*</a></label>
              <select name="title" id="title" class="form-control">
                <option disabled selected>-Select-</option>
                    @foreach($title as $patient_title)                                        
                      <option value="{{ $patient_title->title }}">{{ $patient_title->title }}</option>
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
                    <option value="{{ $patient_gender->gender_id }}">{{ $patient_gender->gender }}</option>
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
                  <option value="{{ $u_u->religion_id }}">{{ $u_u->religion }}</option>
                 @endforeach
               </select>
            </div>
            <div class="col">
              <label class="form-label" for="nationality">Nationality <a style="color: red;">*</a></label>
              <select name="nationality" id="nationality" class="form-control">
                <option disabled selected>-Select-</option>
                <option value="10001">Ghanaian</option>
                <option value="20001">Non-Ghanaian</option>
              </select>
            </div>
            <div class="col">
              <label class="form-label" for="ghana_card">Ghana Card Number</label>
              <input type="text" class="form-control" id="ghana_card" name="ghana_card" placeholder="GH-0000000-x" autocomplete="off">
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
              <select name="town" id="town" class="form-control">
                <option value="" disabled selected>-Select-</option>
                   @foreach($towns as $town)                                        
                     <option value="{{ $town->towns }}">{{ $town->towns }}</option>
                   @endforeach
              </select>
            </div>
            <div class="col">
              <label class="form-label" for="region">Region</label>
              <select name="region" id="region" class="form-control">
                <option value="" disabled selected>-Select-</option>
                @foreach($region as $regions)                                        
                  <option value="{{ $regions->region_id }}">{{ $regions->region }}</option>
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
                  <option value="{{ $rel->relation_id }}">{{ $rel->relation }}</option>
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
          <!-- <br> -->
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
             <select name="sponsor_type_id" id="sponsor_type_id" class="form-control sponsor_type">
              <option disabled selected>-Select-</option>
                @foreach($payment_type as $payments)                                        
                  <option value="{{ $payments->sponsor_type_id }}">{{ $payments->sponsor_type }}</option>
                 @endforeach
              <!-- <option disable selected>-Select sponsor-</option>
              <option value="1001">Cash</option> 
              <option value="20001">Public NHIS</option>
              <option value="3000">Co-operate Company</option>
              <option value="4004">Private Insurance</option> -->
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
                @foreach($sponsor as $sponsors)                                        
                  <option value="{{ $sponsors->sponsor_id }}">{{ $sponsors->sponsor_name }}</option>
                 @endforeach
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
              <span>Card Status</span></label>
            <input type="text" name="card_status" id="card_status" class="form-control" disabled>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-label-secondary">clear</button>
    </div>
  </form>
  </div>
</div>
</div>   

          <!-- add Modal -->
          <div class="modal fade" id="mdoal_form" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
          <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
              <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                  <h3>Patient Search Criteria</h3>
                  <!-- <p>Enter Search criteria <b style="color:red">All fields marked (*) are mandatory.</b></p> -->
                </div>
                <form id="employee_add" class="row g-3" onsubmit="return false" method="post">
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="telephone">Search Criteria <label class="text-danger" style="font-size: 15px;">*</label></label>
                     <select name="search_name" id="search_name" class="form-control">
                      <option selected disabled>-Select-</option>
                      <option value="opd_number">OPD #</option>
                      <option value="membership_number">Membership #</option>
                      <option value="firstname">Firstname</option>
                      <option value="surname">Surname</option>
                      <option value="middlename">Middlename</option>
                      <option value="telephone">Telephone</option>
                     </select>
                  </div>
                  <!-- <div class="col-12 col-md-6">
                    <label class="form-label" for="ssnit_number">Registration Date</label>
                    <input type="date" id="data_search" name="data_search" class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                  </div> -->
                  <!-- <div class="col-12 col-md-6">
                    <label class="form-label" for="gh_card">Date of Birth</label>
                    <input type="date" id="gh_card" name="gh_card" class="form-control modal-edit-tax-id" placeholder="123 456 7890" />
                  </div> -->
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="staff_type">Criteria<label class="text-danger" style="font-size: 15px;">*</label></label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Firstname/Middlename/Surname">
                  </div>
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Search</button>
                    <button type="reset" class="btn btn-label-warning me-sm-3 me-1">Clear</button>
                    <button type="reset" class="btn btn-label-danger" data-bs-dismiss="modal" aria-label="Close">close</button>
                  </div>
                </form>
              </div>
              <div class="table table-hover">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Sn</th>
                      <th>Patient Name</th>
                      <th>Date of Birth</th>
                      <th>Category</th>
                      <th>Member #</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="6" align="center">No Data Available</td>
                    </tr>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th>Sn</th>
                      <th>Patient Name</th>
                      <th>Date of Birth</th>
                      <th>Category</th>
                      <th>Member #</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- end modal -->
</x-app-layout>