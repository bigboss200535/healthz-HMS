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
                        <input type="text" value="" id="patient_status" name="patient_status" hidden>
                        <input type="text" value="{{ $consultation_id }}" id="consultation_id" name="consultation_id" hidden>
                        <input type="text" value="{{ $attendance->episode_id }}" id="episode_id" name="episode_id" hidden>
                        <input type="text" value="{{ $attendance->attendance_id }}" id="attendance_id" name="attendance_id" hidden>
                        <input type="text" value="{{ $attendance->gender_id }}" id="gender_id" name="gender_id" hidden>
                        <input type="text" value="{{ $attendance->age_id }}" id="age_id" name="age_id" hidden>
                        <input type="text" value="{{ $attendance->patient_id }}" id="con_patient_id" name="con_patient_id" hidden>
                        <input type="text" value="{{ $attendance->opd_number }}" id="con_opd_number" name="con_opd_number" hidden>
                        <input type="text" value="{{ $attendance->full_age }}" id="con_full_age" name="con_full_age" hidden>
                        <input type="text" value="{{ $attendance->sponsor_id }}" id="con_sponsor" name="con_sponsor" hidden>
                        <input type="text" value="{{ $attendance->sponsor_type_id }}" id="con_sponsor_type" name="con_sponsor_type" hidden>
                        <input type="text" value="{{ $attendance->pat_clinic }}" id="con_clinic" name="con_clinic" hidden>
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
                         <b>Age: </b>{{ $attendance->full_age}}
                      </td>
                    </tr>
                    <tr>
                      <td class="text-center">
                         <b>OPD #: </b>{{ $attendance->opd_number}} 
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
                           @foreach($consulting_room as $room)                                        
                              <option value="{{ $room->consulting_room_id}}">{{ $room->consulting_room }}</option>
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
               <tr>
                <td><b>Action</b></td>
                  <td>
                        <!-- <button type="button" id="consultation_continue" class="btn btn-sm btn-primary">Proceed</button> -->
                  </td>
                </tr>
                <tr>
                <td><b>Outcome</b></td>
                  <td>
                        <button type="button" disabled class="btn btn-sm btn-danger" id="discharge_patient">Discharge</button>
                  </td>
                </tr>
            </table>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- <br> -->
<!-- Add a message to inform the user what's needed -->
@php 
  $doctor = \App\Models\User::where('user_id', $user->user_id)->first();
@endphp

    <div class="card mb-6" id="required_fields_message">
        <div class="card-widget-separator-wrapper">
              <div class="card-body card-widget-separator">
                   <div class="row gy-4 gy-sm-1">
                       <div class="col-sm-6 col-lg-12">
                          <h6 style="color: red" align='center'><i class="bx bx-info-circle me-1"></i>
                             Please complete all <b>CONSULTATION</b> details before proceeding
                          </h6>
                          <div class="col-sm-6 col-lg-12" align='center'>
                              <button type="button" id="consultation_continue" class="btn btn-sm btn-primary">PROCEED</button>
                          </div>
                        </div>
                   </div>
              </div>
        </div>
     </div>
<!-- <br> -->
<!-- The existing consultation display div remains unchanged -->
<div class="card mb-6" id="consultation_display">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
                <div class="col-12 pull-right">
                    <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#add_" class="btn btn-sm btn-primary">VISIT OUTCOME</button> -->
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
   <div class="tab-pane fade" id="nav_all_diagnosis" role="tabpanel">  <!--------------FOR DIAGNOSIS -->
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
                                                                                                <th>SN</th>
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
                                                                                                <th>SN</th>
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
                                                                                          <ul class="timeline timeline-outline mb-0">
                                                                                              @foreach($diagnosis_history as $p_diagnosis) 
                                                                                              <li class="timeline-item timeline-item-transparent border-dashed">
                                                                                                <span class="timeline-point timeline-point-primary"></span>
                                                                                                <div class="timeline-event">
                                                                                                  <div class="timeline-header mb-3">
                                                                                                    <h6 class="mb-0">DOCTOR: <label>{{ $p_diagnosis->doctor }}</label></h6>
                                                                                                    <small class="text-body-dark"><label><b>DIAGNOSIS</b> {{ $p_diagnosis->diagnosis }}</label> </small>
                                                                                                    <small class="text-body-dark"><label><b>SYMPTOM</b> {{ $p_diagnosis->icd_10 }} </label> </small>
                                                                                                    <small class="text-body-dark"><label><b>G-DRG</b> {{ $p_diagnosis->gdrg_code }} </label> </small>
                                                                                                    <small class="text-body-dark"><label><b>DATE</b> {{ $p_diagnosis->entry_date }}</label> </small>
                                                                                                  </div>
                                                                                                </div>
                                                                                              </li>
                                                                                                @endforeach
                                                                                            </ul>
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
                                                                                      <div class="col-12" >
                                                                                        <button type="button" data-bs-toggle='modal' data-bs-target="#add_prescriptions" class="btn btn-sm btn-primary">ADD PRESCRIPTIONS</button>
                                                                                      <table class="table table-responsive" id="prescriptions_list">
                                                                                            <thead>
                                                                                              <tr>
                                                                                                <th>Sn</th>
                                                                                                <th>Prescription</th>
                                                                                                <th>Prescription Qty</th>
                                                                                                <th>Prescription date</th>
                                                                                                 <th>Doctor</th>
                                                                                                <th>Sponsor Type</th>
                                                                                                <th>Prescription Type</th>
                                                                                                <th>Action</th>
                                                                                              </tr>
                                                                                            </thead>
                                                                                            <tfoot>
                                                                                             <tr>
                                                                                                <th>Sn</th>
                                                                                                <th>Prescription</th>
                                                                                                <th>Prescription Qty</th>
                                                                                                <th>Prescription date</th>
                                                                                                 <th>Doctor</th>
                                                                                                <th>Sponsor Type</th>
                                                                                                <th>Prescription Type</th>
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
                                                                                            <tbody>

                                                                                            </tbody>
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
                      <button type="submit" class="btn btn-primary me-3"><i class="bx bx-save"></i>Submit</button>
                      <button type="reset" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i>Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/ PATIENT DIAGNOSIS MODAL -->

           <!-- PATIENT PRESCRIPTION MODAL -->
           <div class="modal fade" id="add_prescriptions" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="mb-6">
                    <h4 class="address-title mb-2">Medications / Prescriptions</h4>
                  </div>
                    <div class="alert-container-drug"></div>
                  <form id="add_prescription_form" class="row g-6" onsubmit="return false">
                      @csrf
                     <input type="text" id="prescription_attendance_id" name="prescription_attendance_id" value="{{ $attendance->attendance_id }}" hidden>
                     <input type="text" id="prescription_opdnumber" name="prescription_opdnumber" value="{{ $attendance->opd_number }}" hidden>
                     <input type="text" id="prescription_patient_id" name="prescription_patient_id" value="{{ $attendance->patient_id }}" hidden>
                     <input type="text" id="prescription_product_id" name="prescription_product_id" hidden>
                     <input type="text" name="prescription_presentation_input" id="prescription_presentation_input" hidden> 
                     <input type="text" name="prescription_base_unit" id="prescription_base_unit" hidden> 
                    
                     <div id="success_diplay" class="container mt-6"></div>

                    <div class="col-12 col-md-12">
                      <label class="form-label" for="prescription_search">Search Medications</label>
                      <input type="text" id="prescription_search" name="prescription_search" class="form-control" placeholder="Enter Medication" autocomplete="off"/>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_dosage">Dosage</label>
                      <div class="input-group">
                      <input type="text" class="form-control" name="prescription_dosage" id="prescription_dosage"/>
                      <span class="input-group-text" id="prescription_presentation"> </span>
                      </div>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_frequency">Frequency</label>
                      <select name="prescription_frequency" id="prescription_frequency" class="form-control" required>
                        <option selected disabled>-Select-</option>
                            @php
                                $frequencies = \App\Models\Frequencies::get();
                            @endphp
                            @foreach($frequencies as $frequency)
                                <option value="{{ $frequency->frequencies }}">{{ $frequency->frequencies }}</option>
                            @endforeach
                     </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_duration">Duration</label>
                     <select name="prescription_duration" id="prescription_duration" class="form-control" required>
                       <option disabled selected>-Select-</option>
                          @for($i = 1; $i <= 120; $i++)
                              <option value="{{ $i }}">{{ $i }}</option>
                          @endfor
                     </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_qty">Qty</label>
                      <input type="number" id="prescription_qty" name="prescription_qty" class="form-control"/>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_price">Unit Price</label>
                      <input type="text" id="prescription_price" name="prescription_price" class="form-control" readonly />
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_type">Type</label>
                      <select name="prescription_type" id="prescription_type" class="form-control">
                        <option value="INWARD" selected>INWARD</option>
                        <option value="OUTWARD">OUTWARD</option>
                      </select>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_start_date">Prescription Date</label>
                      <input type="date" id="prescription_start_date" name="prescription_start_date" class="form-control" value="<?php echo date('Y-m-d'); ?>"  readonly/>
                    </div>
                    <div class="col-12 col-md-3">
                      <label class="form-label" for="prescription_end_date">End Date</label>
                      <input type="date" id="prescription_end_date" name="prescription_end_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly />
                    </div>
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="prescription_sponsor">Sponsor</label>
                        <select name="prescription_sponsor" id="prescription_sponsor" class="form-control">
                              @php
                                  $patient_sponsor = \App\Models\PatientSponsor::where('patient_id', $attendance->patient_id)
                                      ->where('is_active', 'Yes') 
                                      ->first();

                                    if(!$patient_sponsor)
                                    {
                                        $sponsors = \App\Models\Sponsors::where('sponsor_id', '100')->get();
                                    }else 
                                    {
                                        $sponsors = \App\Models\PatientSponsor::where('patient_sponsorship.archived', 'No')
                                          ->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_sponsorship.sponsor_id')
                                          ->where('patient_sponsorship.patient_id', $attendance->patient_id )
                                          ->get();
                                    }
                                  
                              @endphp

                              @foreach($sponsors as $sponsor)
                                  <option value="{{ $sponsor->sponsor_id }}">{{ $sponsor->sponsor_name }}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="prescription_gdrg">Drug G-RDG</label>
                      <input type="text" id="prescription_gdrg" name="prescription_gdrg" class="form-control" disabled />
                    </div>
                    <div class="col-12">
                      <div class="form-check form-switch my-2 ms-2">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary me-3"><i class="bx bx-save"></i> Submit</button>
                      <button type="reset" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close"><i class="bx bx-x"></i> Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/ PRESCRIPTION MODAL -->
</x-app-layout>