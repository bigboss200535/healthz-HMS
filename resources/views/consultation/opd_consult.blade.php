<x-app-layout>
<?php 
    $today = date('Y-m-d'); 
    $currentTime = date('H:i'); 
    // Get the current time in HH:MM format
?>
<style>
    #diagnosis_results {
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-top: 5px;
    display: none;
    position: absolute;
    background: white;
    z-index: 1000;
    width: 100%;
  }

  .diagnosis-item {
    cursor: pointer;
    padding: 8px;
    background-color: #f9f9f9;
    border-bottom: 1px solid #eee;
  }

  .diagnosis-item:hover {
    background-color: #e9ecef;
  }
</style>
<div class="container-xxl flex-grow-1 container-p-y">    
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-center card-widget-3 border-end pb-4 pb-sm-0">
                <table class="table">
                  <form id="consultation_form" method="post">
                      @csrf
                  <input type="text" value="{{ $attendance->episode_id }}" id="episode_id" name="episode_id" hidden>
                  <input type="text" value="{{ $attendance->attendance_id }}" id="attendance_id" name="attendance_id" hidden>
                  <input type="text" value="{{ $attendance->gender_id }}" id="gender_id" name="gender_id" hidden>
                  <input type="text" value="{{ $attendance->age_id }}" id="age_id" name="age_id" hidden>
                    <tr>
                      <td class="text-center"><h5><b>{{ $attendance->fullname}}</b></h5></td>
                    </tr>
                    <tr>
                      <td class="text-center">
                          <img src="{{ $attendance->gender==='FEMALE' ? asset('img/avatars/female.jpg') : asset('img/avatars/male.jpg') }}" 
                          alt="Patient Image" class="rounded-pill" style="border:1px;border-color:black; box-shadow:10px; width:50%" 
                          align="center">
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                        <table class="table">
                          <tr>
                            <td><b>OPD #:</b><br> {{ $attendance->opd_number}}</td>
                            <td style="width: 2px; background-color: #dee2e6; padding: 0;"></td>
                            <td><b>Age: </b><br>{{ $attendance->full_age}}</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                  </table>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <!-- <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3"> -->
          <div class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
           <p>
           <table class="table table-striped">
              <tr>
                <td><b>Gender:</b></td>
                <td>{{ $attendance->gender}}</td>
              </tr>
              <tr>
                <td><b>Clinic:</b></td>
                <td>{{ $attendance->pat_clinic}}</td>
              </tr>
              <tr>
                <td><b>Sponsor Type:</b></td>
                <td><span class="badge bg-label-danger">{{ $attendance->sponsor_type}}</span></td>
              </tr>
              <tr>
                <td><b>Sponsor Name:</b></td>
                <td><span class="badge bg-label-primary">{{ $attendance->sponsor}}</span></td>
              </tr>
              <tr>
                  <td><b>Consultation Type</b></td>
                  <td>
                      <select name="consulting_type" id="consulting_type" class="form-control">
                            <option value="NEW" Selected>NEW</option>
                            <option value="OLD">OLD</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><b>Episode</b></td>
                  <td>
                    <select name="consulting_episode" id="consulting_episode" class="form-control">
                        <option value="ACUTE" selected>ACUTE</option>
                        <option value="CHRONIC">CHRONIC</option>
                    </select>
                  </td>
                </tr>
            </table>
           </p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-5">
          <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
           <table class="table table-striped">
              <tr>
                <td><b>Room #</b></td>
                <td>
                    <select name="consulting_room" id="consulting_room" class="form-control">
                         <option disabled selected>-Select-</option>
                           @foreach($con_room as $consulting_room)                                        
                              <option value="{{ $consulting_room->consulting_room_id}}">{{ $consulting_room->consulting_room }}</option>
                           @endforeach
                    </select>
                </td>
              </tr>
              <tr>
                <td><b>Time</b></td>
                <td>
                  
                  <input type="time" class="form-control" name="consulting_time" id="consulting_time" value="<?php echo $currentTime; ?>">
                </td>
              </tr>
              <tr>
                <td><b> Doctor</b></td>
                <td>
                    <select name="consulting_doctors" id="consulting_doctors" class="form-control">
                        @php
                          
                              $user = Auth::user(); // Get the logged-in user
                            if($user && $user->user_roles_id === 'R10') { // Check if user has role R10
                                $doctor = \App\Models\User::where('user_id', $user->user_id)->first();  // Display only the logged-in doctor if they have role R10
                                
                                if($doctor) {
                                    echo '<option value="'.$doctor->user_id.'" selected disabled>'.$doctor->title.' '.strtoupper($doctor->user_fullname).'</option>';
                                }

                            } else {
                                
                                 //$doctors = \App\Models\User::where('user_roles_id', 'R10') // Display all doctors for other roles
                                 $doctors = \App\Models\User::where('archived', 'No') // Display all doctors for other roles
                                        ->orderBy('user_fullname', 'asc')
                                        ->get();
                                
                                foreach($doctors as $doc) {
                                    echo '<option value="'.$doc->user_id.'">'.$doc->title.' '.strtoupper($doc->user_fullname).'</option>';
                                }
                            }
                        @endphp
                    </select>
                </td>
              </tr>
              <tr>
                <td><b> Date</b></td>
                <td>
                  <input type="date" class="form-control" id="consulting_date" name="consulting_date" value="{{ $today }}">
                </td>
              </tr>
              <!-- <tr>
                <td><b> Outcome</b></td>
                  <td>
                  <select name="consulting_outcome" id="consulting_outcome" class="form-control">
                             <option selected disabled></option>
                            <option value="PENDING DIAGNOSTIC">PENDING DIAGNOSTIC</option>
                            <option value="DISCHARGED">DISCHARGED</option>
                            <option value="DISCHARGED AGAINST MEDICAL ADVICE">DISCHARGED AGAINST MEDICAL ADVICE</option>
                      </select>
                  </td>
              </tr> -->
               <tr>
                <td><label for=""></label></td>
                  <td>
                     <div class="btn-group">
                        <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#claims_check_code" class="btn btn-sm btn-info">GET CCC </button> -->
                        <!-- <button type="button" class="btn btn-sm btn-warning edit-btn">Review</button> -->
                        <button type="button" id="consultation_continue" class="btn btn-sm btn-primary">Continue To Consult</button>
                     </div>
                  </td>
                </tr>
            </table>
          </form>
           <!-- </p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <br> -->
<!-- Add a message to inform the user what's needed -->
    <div class="card mb-6" id="required_fields_message">
        <div class="card-widget-separator-wrapper">
              <div class="card-body card-widget-separator">
                   <div class="row gy-4 gy-sm-1">
                       <div class="col-sm-6 col-lg-12">
                          <h6 style="color: red" align='center'><i class="bx bx-info-circle me-1"></i>
                             Please complete all <b>CONSULTATION</b> details before proceeding
                          </h6>
                          <!-- <h4 class="text-dark text-center"> <b style="color:green">SELECT ALL REQUIRED FIELDS:</b> Consultation Type, Doctor, Consulting Date, and Episode.</h4> -->
                        </div>
                   </div>
              </div>
        </div>
     </div>
<!-- <br> -->
<!-- The existing consultation display div remains unchanged -->
<div class="card mb-6" id="consultation_display" style="display: none;">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
                <div class="col-12 pull-right">
                    <button type="button" data-bs-toggle='modal' data-bs-target="#add_" class="btn btn-sm btn-primary">VISIT OUTCOME</button>
                           <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#_history" class="btn btn-sm btn-danger">HISTORY</button> -->
                </div>
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-12">
             <div class="card-body">
                      <div class="nav-align-top nav-tabs-shadow mb-6">
                            <ul class="nav nav-tabs nav-fill" role="tablist">
                              <li class="nav-item">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs_vitals" aria-controls="navs_vitals" aria-selected="true">
                                    <span class="d-none d-sm-block"><b>Vital Signs</b></span>
                                  </button>
                                </li>
                              <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_medical" aria-controls="navs_medical" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>History/Medical Conditions</b></span>
                                  </button> 
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_clinical" aria-controls="navs_clinical" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Clinical Notes</b></span>
                                  </button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_systems" aria-controls="navs_systems" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Review of Systems</b> </span>
                                  </button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_all_diagnosis" aria-controls="nav_all_diagnosis" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Diagnosis</b></span>
                                  </button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_trying" aria-controls="navs_trying" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Prescriptions</b></span>
                                  </button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_investigations" aria-controls="navs_investigations" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Investigations</b></span>
                                  </button>
                                </li>
                                <li class="nav-item">
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_document" aria-controls="navs_document" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Charts /Documents</b></span>
                                  </button>
                                </li>
                            </ul>
                        <div class="tab-content">
                          <!-- TABS VIEWS -->
                             <div class="tab-pane fade  show active" id="navs_vitals" role="tabpanel">  <!--------------VITAL SIGNS -->
                                 <h5>Vital Signs</h5>
                                    <div class="row g-6 mb-12">
                                          <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="browser-default-validation">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_" class="btn btn-sm btn-primary">ADD VITAL SIGNS</button>
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#_history" class="btn btn-sm btn-danger">HISTORY</button>
                                                    </div>
                                                  </div>
                                                </form>
                                                 <table class="table table-responsive" id="patient_list">
                                                    <thead>
                                                      <tr>
                                                        <th>SN</th>
                                                        <th>Date</th>
                                                        <th>Pressure</th>
                                                        <th>Weight</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Date</th>
                                                        <th>Pressure</th>
                                                        <th>Weight</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>BMI</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </tfoot>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                          <!-- <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="needs-validation" novalidate>
                                                  <div class="row">
                                                  
                                                    <div class="col-12">
                                                       <canvas id="vital_sign_chart"></canvas>
                                                    </div>
                                                   
                                                  </div>
                                                </form>
                                                 
                                              </div>
                                            </div>
                                          </div> -->
                                        </div>
                                </div>

                            <div class="tab-pane fade" id="navs_clinical" role="tabpanel"> <!--------------CLINIC NOTES -------------->
                              <h5>Clinical Notes</h5>
                              <div class="row mb-7 g-12">
                                <div class="col-md">
                                  <div class="accordion mt-4" id="#">
                                    <div class="accordion-item active" style="border-color:rgb(255, 3, 3); border-width: 2px;">
                                      <h2 class="accordion-header d-flex align-items-center">
                                         <b class="accordion-button">Vital Signs</b>
                                      </h2>
                                      <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                          Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. 
                                          Sesame snaps icing marzipan gummi bears macaroon dragée danish caramels powder. 
                                          Bear claw dragée pastry topping soufflé. Wafer gummi bears marshmallow pastry pie.
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--/ Accordion with Icon -->
                                <!-- Accordion Header Color -->
                                <div class="col-md">
                                  <div class="accordion mt-4 accordion-header-primary" id="accordionStyle1" >
                                    <div class="accordion-item active" style="border-color:rgb(0, 0, 0); border-width: 2px;">
                                      <h2 class="accordion-header d-flex align-items-center">
                                      <b class="accordion-button">History</b>
                                      </h2>
                                      <div id="accordionStyle1-1" class="accordion-collapse collapse show" data-bs-parent="#accordionStyle1">
                                        <div class="accordion-body">
                                          Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. 
                                          Sesame snaps icing marzipan gummi bears macaroon dragée danish caramels powder. 
                                          Bear claw dragée pastry topping soufflé. Wafer gummi bears marshmallow pastry pie.
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row mb-7 g-12">
                                <!-- Accordion with Icon -->
                                <div class="col-md">
                                  <div class="accordion mt-4" id="#">
                                    <div class="accordion-item active" style="border-color:rgb(255, 3, 3); border-width: 2px;">
                                      <h2 class="accordion-header d-flex align-items-center">
                                         <b class="accordion-button" style="background-color:red; color:white">Vital Signs</b>
                                      </h2>
                                      <div id="accordionWithIcon-1" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                          Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. 
                                          Sesame snaps icing marzipan gummi bears macaroon dragée danish caramels powder. 
                                          Bear claw dragée pastry topping soufflé. Wafer gummi bears marshmallow pastry pie.
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--/ Accordion with Icon -->
                                <!-- Accordion Header Color -->
                                <div class="col-md">
                                  <div class="accordion mt-4 accordion-header-primary" id="accordionStyle1" >
                                    <div class="accordion-item active" style="border-color:rgb(0, 0, 0); border-width: 2px;">
                                      <h2 class="accordion-header d-flex align-items-center">
                                      <b class="accordion-button">History</b>
                                      </h2>
                                      <div id="accordionStyle1-1" class="accordion-collapse collapse show" data-bs-parent="#accordionStyle1">
                                        <div class="accordion-body">
                                          Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. 
                                          Sesame snaps icing marzipan gummi bears macaroon dragée danish caramels powder. 
                                          Bear claw dragée pastry topping soufflé. Wafer gummi bears marshmallow pastry pie.
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              </div>
                             <!-- ---------------------------------------------------------------------------------- -->

                             <div class="tab-pane fade" id="navs_medical" role="tabpanel">     <!----- HISTORY of patient  -------->
                              <h5>History /Medical Conditions</h5>
                                   
                                    <div class="row g-6 mb-12">
                                          <div class="col-md">
                                                    <div class="nav-align-top nav-tabs-shadow mb-6" >
                                                          <ul class="nav nav-tabs nav-fill" role="tablist" >

                                                            <li class="nav-item">
                                                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs_new_history" aria-controls="navs_new_history" aria-selected="true">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">New History</b></span>
                                                                </button>
                                                            </li>
                                                            <li class="nav-item">
                                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_previous_history" aria-controls="navs_previous_history" aria-selected="false">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Previous History</b></span>
                                                                </button> 
                                                            </li>
                                                              
                                                          </ul>
                                                          <!-- tab content 1-->
                                                            <div class="tab-content">
                                                            <!-- 1 -->  
                                                                      <div class="tab-pane fade show active" id="navs_new_history" role="tabpanel">  <!--------------new history -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                      <div class="col-12" >
                                                                                        <table class="table table">
                                                                                          <thead>
                                                                                            <tr>
                                                                                              <th><b>Select</b></th>
                                                                                              <th><b>Clinical History</b></th>
                                                                                              <th><b>Clinical Questions</b></th>
                                                                                              <th><b>Response</b></th>
                                                                                              <th><b>Actions</b></th>
                                                                                            </tr>
                                                                                          </thead>
                                                                                         <tbody>
                                                                                            @foreach($clinical_history as $history)
                                                                                              @if(isset($grouped_questions[$history->clinical_history_id]))
                                                                                                @foreach($grouped_questions[$history->clinical_history_id] as $index => $question)
                                                                                                  <tr>
                                                                                                    <td width="5%">
                                                                                                      <input type="checkbox" class="form-check-input" name="selected_questions[]" value="{{ $question->clinical_history_qtn_id }}">
                                                                                                    </td>
                                                                                                    <td width="20%">
                                                                                                        @if($index === 0)
                                                                                                          <b>{{ $history->clinical_history }}</b>
                                                                                                        @endif
                                                                                                    </td>
                                                                                                    <td width="40%">
                                                                                                      {{ $question->clinical_history_question }}
                                                                                                    </td>
                                                                                                    <td width="30%">
                                                                                                      <input type="text" class="form-control" name="response[{{ $question->clinical_history_qtn_id }}]" placeholder="Enter response">
                                                                                                    </td>
                                                                                                    <td width="5%">
                                                                                                      <button type="button" class="btn btn-sm btn-primary">Add</button>
                                                                                                    </td>
                                                                                                  </tr>
                                                                                                @endforeach
                                                                                              @endif
                                                                                            @endforeach
                                                                                          </tbody>
                                                                                          <tfoot>
                                                                                            <tr>
                                                                                              <th><b>Select</b></th>
                                                                                              <th><b>Clinical History</b></th>
                                                                                              <th><b>Clinical Questions</b></th>
                                                                                              <th><b>Response</b></th>
                                                                                              <th><b>Actions</b></th>
                                                                                            </tr>
                                                                                          </tfoot>
                                                                                        </table>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                <!-- tab content end 1-->
                                                              <!-- 2 -->
                                                                    <div class="tab-pane fade" id="navs_previous_history" role="tabpanel"> <!--------------new previous history -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                  <h6>HISTORY of Patient</h6>
                                                                                  

                                                                                      <div class="col-12" >
                                                                                        <ul class="timeline timeline-outline mb-0">
                                                                                              <li class="timeline-item timeline-item-transparent border-dashed">
                                                                                                <span class="timeline-point timeline-point-primary"></span>
                                                                                                <div class="timeline-event">
                                                                                                  <div class="timeline-header mb-3">
                                                                                                    <h6 class="mb-0">Doctor: <label>Dr. Ansah Sasraku Jnr</label></h6>
                                                                                              
                                                                                                    <small class="text-body-dark">
                                                                                                      <a href="#" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i> </a>
                                                                                                    </small>
                                                                                                  </div>
                                                                                                  <p class="mb-2"><b>REMARKS:</b> Invoices have been paid to the company</p>
                                                                                                </div>
                                                                                              </li>
                                                                                            </ul>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                            </div>
                                                      <!-- tab content end -->          
                                                  </div>
                                          </div>
                                        </div>
                             
                                <!------------------------------------------------------------------------------------------------------------------------------->
 


                              
                                </div>
  <!----------------------------------------------------------------------------------------------------------------------------- -->
                                <div class="tab-pane fade" id="navs_systems" role="tabpanel">     <!--------------REVIEW OF SYSTEM -->
                                    <div class="row g-6 mb-12">
                                          <div class="col-md">
                                                    <div class="nav-align-top nav-tabs-shadow mb-6" >
                                                          <ul class="nav nav-tabs nav-fill" role="tablist" >
                                                            <li class="nav-item">
                                                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs_review_of_system" aria-controls="navs_vitals" aria-selected="true">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Review of Systems</b></span>
                                                                </button>
                                                              </li>
                                                            <li class="nav-item">
                                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_exams_finding" aria-controls="navs_medical" aria-selected="false">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Examinations/Findings</b></span>
                                                                </button> 
                                                              </li>
                                                              <li class="nav-item">
                                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_eye_exams" aria-controls="navs_clinical" aria-selected="false">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Eye Examination</b></span>
                                                                </button>
                                                              </li>
                                                          </ul>
                                                          <!-- tab content 1-->
                                                            <div class="tab-content">
                                                              <!-- 1 -->
                                                                    <div class="tab-pane fade  show active" id="navs_review_of_system" role="tabpanel">  <!--------------REVIEW OF SYSTEMS/EXAMINATIONS -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                  <h6>HISTORY OF REVIEW OF SYSTEMS/EXAMINATIONS</h6>
                                                                                  <hr>
                                                                                  <table class="table">
                                                                                    <div class="col-12">
                                                                                            <ul class="timeline timeline-outline mb-0">
                                                                                              <li class="timeline-item timeline-item-transparent border-dashed">
                                                                                                <span class="timeline-point timeline-point-primary"></span>
                                                                                                <div class="timeline-event">
                                                                                                  <div class="timeline-header mb-3">
                                                                                                    <h6 class="mb-0">Doctor: <label>Dr. Ansah Sasraku Jnr</label></h6>
                                                                                                    <small class="text-body-dark"><label><b>System</b>: GENERAL/CONSTITUTIONAL</label> </small>
                                                                                                    <small class="text-body-dark"><label><b>SYMPTOM:</b> FEVER</label> </small>
                                                                                                    <small class="text-body-dark"><label><b>DATE:</b> 12/03/2025</label> </small>
                                                                                                    <small class="text-body-dark">
                                                                                                      <a href="#" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i> </a>
                                                                                                      <!-- <button type="button" class="btn btn-sm btn-danger">Delete</button> -->
                                                                                                    </small>
                                                                                                  </div>
                                                                                                  <p class="mb-2"><b>REMARKS:</b> Invoices have been paid to the company</p>
                                                                                                </div>
                                                                                              </li>
                                                                                            </ul>
                                                                                  </div>
                                                                                  </table>
                                                                                      <br>
                                                                                      <hr>
                                                                                 <table class="table table-hover">
                                                                                    <div class="col-3">
                                                                                           <h6 class="pull-right"> <i class="bx bx-info-circle me-1"></i> Select a System to Review</h6>
                                                                                    </div>
                                                                                    <div class="col-9">
                                                                                        <select class="form-control" id="systemic_review" name="systemic_review">
                                                                                              <option selected disabled>-Select a system-</option>
                                                                                                  @foreach($systemic as $systemics)                                        
                                                                                                      <option value="{{ $systemics->systemic_id}}">{{ $systemics->systemic_item }}</option>
                                                                                                  @endforeach
                                                                                          </select>
                                                                                    </div>
                                                                                 </table>
                                                                                   <!-- <hr> -->
                                                                                      <br>
                                                                                      <div class="col-12" >
                                                                                        <div>
                                                                                          <table class="table table-hover" id="symptoms-table">
                                                                                          <thead>
                                                                                            <tr>
                                                                                              <th>Select</th>
                                                                                              <th>Symptom</th>
                                                                                              <th style="width: 40%;">Remarks</th>
                                                                                              <th>Action</th>
                                                                                            </tr>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                          
                                                                                          </tbody>
                                                                                        </table>
                                                                                        </div>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                      <!-- 2 -->
                                                                      <div class="tab-pane fade" id="navs_exams_finding" role="tabpanel">  <!--------------VITAL SIGNS -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                      <div class="col-12" >
                                                                                        <table class="table table">
                                                                                          <thead>
                                                                                            <tr>
                                                                                              <th>Select</th>
                                                                                              <th><b>Systems</b></th>
                                                                                              <th><b>Examination / Findings</b></th>
                                                                                              <th><b>Action</b></th>
                                                                                            </tr>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                          @foreach($systemic as $systemics) 
                                                                                            <tr>
                                                                                              <td>
                                                                                                <input type="checkbox" class="form-check-input" name="select_system" id="select_system">
                                                                                              </td>
                                                                                              <td>{{ $systemics->systemic_item }}</td>
                                                                                              <td>
                                                                                                  <textarea name="exams_with_findings" style="resize: none" id="exams_with_findings" colspan="5" class="form-control"></textarea>
                                                                                              </td>
                                                                                              <td>
                                                                                                <a href="#" class="btn btn-primary"><i class="bx bx-plus"></i></a>
                                                                                              </td>
                                                                                            </tr>       
                                                                                          @endforeach
                                                                                          </tbody>
                                                                                          <tfoot>
                                                                                            <tr>
                                                                                              <th>Select</th>
                                                                                              <th><b>Systems</b></th>
                                                                                              <th><b>Examination / Findings</b></th>
                                                                                              <th><b>Action</b></th>
                                                                                            </tr>
                                                                                          </tfoot>
                                                                                        </table>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                <!-- tab content end 1-->
                                                            </div>
                                                      <!-- tab content end -->          
                                                  </div>
                                          </div>
                                        </div>
                                </div>
                                <!------------------------------------------------------------------------------------------------------------------------------->

   <!------------------------------------------------------------------------------------------------------------------------------->
   <!-- --------------/FOR DIAGNOSIS NEW  -->
   <div class="tab-pane fade" id="nav_all_diagnosis" role="tabpanel">     <!--------------FOR DIAGNOSIS -->
                                    <div class="row g-6 mb-12">
                                          <div class="col-md">
                                                    <div class="nav-align-top nav-tabs-shadow mb-6" >
                                                          <ul class="nav nav-tabs nav-fill" role="tablist" >
                                                            <li class="nav-item">
                                                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs_diagnosis" aria-controls="navs_vitals" aria-selected="true">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Diagnosis</b></span>
                                                                </button>
                                                              </li>
                                                            <li class="nav-item">
                                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_previous_diagnosis" aria-controls="navs_medical" aria-selected="false">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Previous Diagnosis</b></span>
                                                                </button> 
                                                              </li>
                                                          </ul>
                                                          <!-- tab content 1-->
                                                            <div class="tab-content">
                                                              <!-- 1 -->
                                                                    <div class="tab-pane fade  show active" id="navs_diagnosis" role="tabpanel">  <!--------------prescriptions -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <button type="button" data-bs-toggle='modal' data-bs-target="#add_diagnosis" class="btn btn-sm btn-primary">ADD DIAGNOSIS</button>
                                                                                      </div>
                                                                                      
                                                                                      <div class="col-12" >
                                                                                      <table class="table table-responsive" id="diagnosis_list">
                                                                                            <thead>
                                                                                              <tr>
                                                                                                <th>Sn</th>
                                                                                                <th>Diagnosis</th>
                                                                                                <th>ICD-10</th>
                                                                                                <th>GRDG</th>
                                                                                                <th>Is Principal</th>
                                                                                                <th>Provisonal / Final</th>
                                                                                                <th>Doctor</th>
                                                                                                <th>Date</th>
                                                                                                <th>Action</th>
                                                                                              </tr>
                                                                                            </thead>
                                                                                            <tbody></tbody>
                                                                                            <tfoot>
                                                                                              <tr>
                                                                                                <th>Sn</th>
                                                                                                <th>Diagnosis</th>
                                                                                                <th>ICD-10</th>
                                                                                                <th>GRDG</th>
                                                                                                <th>Is Principal</th>
                                                                                                <th>Provisonal / Final</th>
                                                                                                <th>Doctor</th>
                                                                                                <th>Date</th>
                                                                                                <th>Action</th>
                                                                                              </tr>
                                                                                            </tfoot>
                                                                                        </table>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                      <!-- 2 -->
                                                                      <div class="tab-pane fade" id="navs_previous_diagnosis" role="tabpanel">  <!--------------previous diagnosis -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                      <div class="col-12" >

                                                                                      <table class="table table-responsive" id="">
                                                                                        <thead>
                                                                                          <tr>
                                                                                            <th>Sn</th>
                                                                                            <th>Attendance #</th>
                                                                                            <th>Diagnosis</th>
                                                                                            <th>ICD-10</th>
                                                                                            <th>Doctor</th>
                                                                                            <th>Date</th>
                                                                                            <th>Action</th>
                                                                                          </tr>
                                                                                        </thead>
                                                                                        <tfoot>
                                                                                          <tr>
                                                                                            <th>Sn</th>
                                                                                            <th>Attendance #</th>
                                                                                            <th>Diagnosis</th>
                                                                                            <th>ICD-10</th>
                                                                                            <th>Doctor</th>
                                                                                            <th>Date</th>
                                                                                            <th>Action</th>
                                                                                          </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                <!-- tab content end 1-->
                                                            </div>
                                                            
                                                      <!-- tab content end -->          
                                                  </div>
                                          </div>
                                        </div>
                                </div>
            
            <div class="tab-pane fade" id="navs_trying" role="tabpanel">     <!--------------FOR MEDICation -->
                                    <div class="row g-6 mb-12">
                                          <div class="col-md">
                                                    <div class="nav-align-top nav-tabs-shadow mb-6" >
                                                          <ul class="nav nav-tabs nav-fill" role="tablist" >
                                                            <li class="nav-item">
                                                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs_prescriptions" aria-controls="navs_vitals" aria-selected="true">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Prescriptions</b></span>
                                                                </button>
                                                              </li>
                                                            <li class="nav-item">
                                                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_previous_prescription" aria-controls="navs_medical" aria-selected="false">
                                                                  <span class="d-none d-sm-block"><b class="text-dark">Previous Prescriptions</b></span>
                                                                </button> 
                                                              </li>
                                                          </ul>
                                                          <!-- tab content 1-->
                                                            <div class="tab-content">
                                                              <!-- 1 -->
                                                                    <div class="tab-pane fade  show active" id="navs_prescriptions" role="tabpanel">  <!--------------prescriptions -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <button type="button" data-bs-toggle='modal' data-bs-target="#add_prescriptions" class="btn btn-sm btn-primary">ADD PRESCRIPTIONS</button>
                                                                                        <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#prescription_history" class="btn btn-sm btn-danger">PRESCRIPTION HISTORY</button> -->
                                                                                      </div>
                                                                                      
                                                                                      <div class="col-12" >
                                                                                      <table class="table table-responsive" id="prescriptions_list">
                                                                                            <thead>
                                                                                              <tr>
                                                                                                <th>Sn</th>
                                                                                                <th>Prescription</th>
                                                                                                <th>Doctor</th>
                                                                                                <th>Prescription date</th>
                                                                                                <th>Sponsor Type</th>
                                                                                                <th>Action</th>
                                                                                              </tr>
                                                                                            </thead>
                                                                                            <tfoot>
                                                                                            <tr>
                                                                                                <th>Sn</th>
                                                                                                <th>Prescription</th>
                                                                                                <th>Doctor</th>
                                                                                                <th>Prescription date</th>
                                                                                                <th>Sponsor Type</th>
                                                                                                <th>Action</th>
                                                                                              </tr>
                                                                                            </tfoot>
                                                                                        </table>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                      <!-- 2 -->
                                                                      <div class="tab-pane fade" id="navs_previous_prescription" role="tabpanel">  <!--------------VITAL SIGNS -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                      <div class="col-12" >
                                                                                        
                                                                                      <table class="table table-responsive" id="previous_prescription">
                                                                                        <thead>
                                                                                          <tr>
                                                                                            <th>Sn</th>
                                                                                            <th>Prescription</th>
                                                                                            <th>Action</th>
                                                                                          </tr>
                                                                                        </thead>
                                                                                        <tfoot>
                                                                                          <tr>
                                                                                            <th>Sn</th>
                                                                                            <th>Prescription</th>
                                                                                            <th>Action</th>
                                                                                          </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                      </div>                                                                                    
                                                                                </div>
                                                                            </div>
                                                                         </div>
                                                                      </div>
                                                                <!-- tab content end 1-->
                                                            </div>
                                                            
                                                      <!-- tab content end -->          
                                                  </div>
                                          </div>
                                        </div>
                                </div>
                                
                                <div class="tab-pane fade" id="navs_document" role="tabpanel">     <!--------------DOCUMENT MANAGEMENT -->
                                  <p>
                                      <b>document</b> have been paid to the company 
                                                I hate hospitals but all of the staff that helped me today were so helpfully and seemed genuinely concern.
                                                I hate hospitals but all of the staff that helped me today were so helpfully and seemed genuinely concern.
                                                <a href="#"><i class="bx bx-edit"></i></a>
                                   </p>
                                </div>

                                <div class="tab-pane fade" id="navs_investigations" role="tabpanel">     <!--------------INVESTIGATIONS  -->
                                    <div class="row g-6 mb-6">
                                          <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="browser-default-validation">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_" class="btn btn-sm btn-primary">REQUEST NEW SERVICE</button>
                                                      <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#_history" class="btn btn-sm btn-danger"> HISTORY</button> -->
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="service_request">
                                                    <thead>
                                                      <tr>
                                                        <th>SN</th>
                                                        <th>Service Type</th>
                                                        <th>Current Status</th>
                                                        <th>Service Fee</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tfoot>
                                                      <tr>
                                                        <th>SN</th>
                                                        <th>Service Type</th>
                                                        <th>Current Status</th>
                                                        <th>Service Fee</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </tfoot>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="needs-validation" novalidate>
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#add_prescriptions" class="btn btn-sm btn-primary">ADD PRESCRIPTIONS</button> -->
                                                      <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#prescription_history" class="btn btn-sm btn-danger">PRESCRIPTION HISTORY</button> -->
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="xx">
                                                    <thead>
                                                      <tr>
                                                        <th>Sn</th>
                                                        <th>SErvice</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tfoot>
                                                      <tr>
                                                        <th>Sn</th>
                                                        <th>Service</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </tfoot>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                </div>
                                 <!-- TABS VIEWS --> 
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div> 

          <!-- diagnosis Modal -->
          <div class="modal fade" id="add_diagnosis" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="mb-6">
                    <h4>Diagnosis / Diseases</h4>
                  </div>
                  <div class="alert-container"></div>
                  <form id="add_diagnosis_form" class="row g-6" onsubmit="return false">
                    @csrf
                    <input type="text" id="diag_opdnumber" name="diag_opdnumber" value="{{ $attendance->opd_number }}" hidden>
                    <input type="text" id="diag_patient_id" name="diag_patient_id" value="{{ $attendance->patient_id }}" hidden>
                    <input type="text" id="diag_attendance_id" name="diag_attendance_id" value="{{ $attendance->attendance_id }}" hidden>
                    <div id="success_diplay" class="container mt-6"></div>
                    <div class="col-12 col-md-12">
                      <label class="form-label" for="diagnosis_search">Search</label>
                      <input type="text" id="diagnosis_search" name="diagnosis_search" class="form-control" placeholder="Enter Diagnosis" autocomplete="off"/>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="diag_type">Type</label>
                      <select name="diag_type" id="diag_type" class="form-control" required>
                        <option value="NEW" selected>NEW</option>
                        <option value="REVIEW">REVIEW</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="diag_category">Category</label>
                      <select name="diag_category" id="diag_category" class="form-control" required>
                        <option value="FINAL" selected>FINAL</option>
                        <option value="PROVISIONAL">PROVISIONAL</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="diag_principal">Principal</label>
                     <select name="diag_principal" id="diag_principal" class="form-control" required>
                        <option value="YES" selected>YES</option>
                        <option value="NO">NO</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="diag_icd_10">ICD-10</label>
                      <input type="text" id="diag_icd_10" name="diag_icd_10" class="form-control" readonly />
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="diag_gdrg">GDRG Code</label>
                      <input type="text" id="diag_gdrg" name="diag_gdrg" class="form-control" readonly  />
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="diag_fee">Diagnosis Fee</label>
                      <input type="text" id="diag_fee" name="diag_fee" class="form-control" readonly />
                    </div>
                    <div class="col-12 col-md-6" hidden>
                      <label class="form-label" for="diag_id">Diagnosis id</label>
                      <input type="text" id="diag_id" name="diag_id" class="form-control" />
                    </div>
                    <div class="col-12">
                      <div class="form-check form-switch my-2 ms-2">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary me-3"><i class="bx bx-save"></i>Add</button>
                      <button type="reset" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i>Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/ diagnosis Modal -->

           <!-- prescription Modal -->
           <div class="modal fade" id="add_prescriptions" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="mb-6">
                    <h4 class="address-title mb-2">Medications / Prescriptions</h4>
                  </div>
                    <div class="alert-container"></div>
                  <form id="add_medication_form" class="row g-6" onsubmit="return false">
                    @csrf
                    <input type="text" id="pres_opdnumber" name="pres_opdnumber" value="{{ $attendance->opd_number }}" hidden>
                    <input type="text" id="patient_id" name="patient_id" value="{{ $attendance->patient_id }}" hidden>
                    <input type="text" id="pres_product_id" name="pres_product_id" hidden>
                    <div id="success_diplay" class="container mt-6"></div>
                    <div class="col-12 col-md-12">
                      <label class="form-label" for="pres_search">Search Medications</label>
                      <input type="text" id="pres_search" name="pres_search" class="form-control" placeholder="Enter Medication"/>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_dosage">Dosage</label>
                      <div class="input-group">
                      <input type="text" class="form-control" name="pres_dosage" id="pres_dosage"/>
                      <span class="input-group-text" id="pres_presentation">MLS</span>
                      </div>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_frequency">Frequency</label>
                      <select name="pres_frequency" id="pres_frequency" class="form-control" required>
                        <option selected disabled>-Select-</option>
                            @php
                                $frequencies = \App\Models\Frequencies::orderBy('frequency_id', 'asc')->get();
                            @endphp
                            @foreach($frequencies as $frequency)
                                <option value="{{ $frequency->frequency_id }}">{{ $frequency->frequencies }}</option>
                            @endforeach
                     </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_duration">Duration</label>
                     <select name="pres_duration" id="pres_duration" class="form-control" required>
                     <option value="" disabled selected>-Select-</option>
                        @for($i = 1; $i <= 60; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                     </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_qty">Qty</label>
                      <input type="number" id="pres_qty" name="pres_qty" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_price">Unit Price</label>
                      <input type="text" id="pres_price" name="pres_price" class="form-control" disabled />
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_type">Type</label>
                      <select name="pres_type" id="pres_type" class="form-control">
                        <option value="INWARD">IN-WARD</option>
                        <option value="OUTWARD">OUT-WARD</option>
                      </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_start_date">Prescription Date</label>
                      <input type="date" id="pres_start_date" name="pres_start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"  disabled/>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="pres_end_date">End Date</label>
                      <input type="date" id="pres_end_date" name="pres_end_date" class="form-control" disabled />
                    </div>
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="pres_sponsor">Sponsor</label>
                      <select name="pres_sponsor" id="pres_sponsor" class="form-control">
                          @php
                                $sponsors = \App\Models\SponsorType::orderBy('sponsor_type_id', 'asc')->get();
                            @endphp
                            @foreach($sponsors as $sponsor_type)
                                <option value="{{ $sponsor_type->sponsor_type }}">{{ $sponsor_type->sponsor_type }}</option>
                            @endforeach
                        <option value="CASH">CASH PAYMENT</option>
                      </select>
                    </div>
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="pres_gdrg">Drug G-RDG</label>
                      <input type="text" id="pres_gdrg" name="pres_gdrg" class="form-control" disabled />
                    </div>
                    <div class="col-12">
                      <div class="form-check form-switch my-2 ms-2">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary me-3"><i class="bx bx-save"></i> Add</button>
                      <button type="reset" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i> Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/ prescription Modal -->


</x-app-layout>