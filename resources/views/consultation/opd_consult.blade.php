<x-app-layout>
<?php 
  $today = date('Y-m-d'); 
  $currentTime = date('H:i'); // Get the current time in HH:MM format
?>
  
<div class="container-xxl flex-grow-1 container-p-y">    
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-center card-widget-3 border-end pb-4 pb-sm-0">
                <table class="table">
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
                        <select name="visit_type" id="visit_type" class="form-control">
                            <option value="NEW" Selected>NEW</option>
                            <option value="OLD">OLD</option>
                      </select>
                  </td>
                </tr>
                <tr>
                  <td><b>Discharged Outcome</b></td>
                  <td>
                       <a href="#" class="btn btn-primary">Undischarged</a>
                  </td>
                </tr>
            </table>
           </p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
          <p>
           <table class="table table-striped">
              <tr>
                <td><b>Consulting Room</b></td>
                <td>
                  <select name="visit_date" id="visit_date" class="form-control">
                    <!-- <option disabled selected>-Select-</option> -->
                           @foreach($con_room as $consulting_room)                                        
                              <option value="{{ $consulting_room->consulting_room_id}}">{{ $consulting_room->consulting_room }}</option>
                           @endforeach
                  </select>
                </td>
              </tr>
              <tr>
                <td><b>Consultation Time</b></td>
                <td>
                  <input type="time" class="form-control" name="consultation_time" id="consultation_time" value="<?php echo $currentTime; ?>">
                </td>
              </tr>
              <tr>
                <td><b>Consulting Doctor</b></td>
                <td>
                    <select name="doctors" id="doctors" class="form-control">
                      <option value="" selected selected>-Select-</option>
                          @foreach($doctors as $doc)                                        
                                <option value="{{ $doc->user_id}}">{{ $doc->title. ' '. $doc->user_fullname }}</option>
                            @endforeach
                    </select>
                </td>
              </tr>
              <tr>
                <td><b>Consulting Date</b></td>
                <td>
                  <input type="date" class="form-control" id="consultation_date" name="consultation_date" value="{{ $today }}">
                </td>
              </tr>
              <tr>
                <td><b>Episode</b></td>
                <td>
                    <select name="episode_name" id="episode_name" class="form-control">
                        <option value="ACUTE" selected>ACUTE</option>
                        <option value="CHRONIC">CHRONIC</option>
                    </select>
                </td>
              </tr>
            </table>
           </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<br>

<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
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
                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs_diagnosis" aria-controls="navs_diagnosis" aria-selected="false">
                                    <span class="d-none d-sm-block"><b>Diagnosis/Prescriptions</b></span>
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
                                    <div class="row g-6 mb-12">
                                          <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="browser-default-validation">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_diagnosis" class="btn btn-sm btn-primary">ADD VITAL SIGNS</button>
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#diagnosis_history" class="btn btn-sm btn-danger">HISTORY</button>
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

                             <div class="tab-pane fade" id="navs_medical" role="tabpanel">     <!-------------- DIAGNOSIS  -------->
                                    <div class="row g-6 mb-6">
                                          <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="browser-default-validation">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_diagnosis" class="btn btn-sm btn-primary">ADD DIAGNOSIS</button>
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#diagnosis_history" class="btn btn-sm btn-danger">DIAGNOSIS HISTORY</button>
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="diagnosis">
                                                    <thead>
                                                      <tr>
                                                        <th>SN</th>
                                                        <th>Diagnosis</th>
                                                        <th>ICD-10</th>
                                                        <th>GRDG</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tfoot>
                                                      <tr>
                                                        <th>SN</th>
                                                        <th>Diagnosis</th>
                                                        <th>ICD-10</th>
                                                        <th>GRDG</th>
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
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_prescriptions" class="btn btn-sm btn-primary">ADD PRESCRIPTIONS</button>
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#prescription_history" class="btn btn-sm btn-danger">PRESCRIPTION HISTORY</button>
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="drugs">
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
                                                                                    <div class="col-6">
                                                                                          <table class="table table">
                                                                                            <tr></tr>
                                                                                          </table>
                                                                                         <h6 class="text">REVIEW OF SYSTEMS/EXAMINATIONS</h6>
                                                                                          <select class="form-control" id="systemic_review" name="systemic_review">
                                                                                              <option selected disabled>-Select-</option>
                                                                                                  @foreach($systemic as $systemics)                                        
                                                                                                      <option value="{{ $systemics->systemic_id}}">{{ $systemics->systemic_item }}</option>
                                                                                                  @endforeach
                                                                                          </select>
                                                                                      </div>
                                                                                      <br>
                                                                                      <br>
                                                                                      <div class="col-12" >
                                                                                        <table class="table table-striped">
                                                                                          <thead>
                                                                                            <tr>
                                                                                              <th>Systems</th>
                                                                                              <th>Symptom</th>
                                                                                              <th>Remarks</th>
                                                                                              <th>Remarks</th>
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
                                                                      <!-- 2 -->
                                                                      <div class="tab-pane fade" id="navs_exams_finding" role="tabpanel">  <!--------------VITAL SIGNS -->
                                                                        <div class="row g-6 mb-12">
                                                                              <div class="col-md">
                                                                                <div class="row">
                                                                                    <!-- <div class="col-12" >
                                                                                        <h6 class="text">EXAMINATIONS AND FINDINGS</h6>
                                                                                          <select class="form-control" id="systemic_review" name="systemic_review">
                                                                                              <option selected disabled>-Select-</option>
                                                                                                  @foreach($systemic as $systemics)                                        
                                                                                                      <option value="{{ $systemics->systemic_id}}">{{ $systemics->systemic_item }}</option>
                                                                                                  @endforeach
                                                                                          </select>
                                                                                      </div> -->
                                                                                      <div class="col-12" >
                                                                                        <table class="table table">
                                                                                          <thead>
                                                                                            <tr>
                                                                                              <th></th>
                                                                                              <th><b>Systems</b></th>
                                                                                              <th><b>Examination / Findings</b></th>
                                                                                            </tr>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                          @foreach($systemic as $systemics) 
                                                                                            <tr>
                                                                                              <td>
                                                                                                <input type="checkbox" name="select_system" id="select_system">
                                                                                              </td>
                                                                                              <td>{{ $systemics->systemic_item }}</td>
                                                                                              <td>
                                                                                                  <textarea name="exams_with_findings" id="exams_with_findings" colspan="5" class="form-control"></textarea>
                                                                                              </td>
                                                                                            </tr>       
                                                                                          @endforeach
                                                                                          </tbody>
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

                                <div class="tab-pane fade" id="navs_diagnosis" role="tabpanel">     <!--------------DIAGNOSIS  -->
                                    <div class="row g-6 mb-6">
                                          <div class="col-md">
                                            <div class="card">
                                              <div class="card-body">
                                                <form class="browser-default-validation">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_diagnosis" class="btn btn-sm btn-primary">ADD DIAGNOSIS</button>
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#diagnosis_history" class="btn btn-sm btn-danger">DIAGNOSIS HISTORY</button>
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="diagnosis">
                                                    <thead>
                                                      <tr>
                                                        <th>Sn</th>
                                                        <th>Diagnosis</th>
                                                        <th>ICD-10</th>
                                                        <th>GRDG</th>
                                                        <th>Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tfoot>
                                                      <tr>
                                                        <th>Sn</th>
                                                        <th>Diagnosis</th>
                                                        <th>ICD-10</th>
                                                        <th>GRDG</th>
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
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_prescriptions" class="btn btn-sm btn-primary">ADD PRESCRIPTIONS</button>
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#prescription_history" class="btn btn-sm btn-danger">PRESCRIPTION HISTORY</button>
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="drugs">
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
                                                      <button type="button" data-bs-toggle='modal' data-bs-target="#add_diagnosis" class="btn btn-sm btn-primary">REQUEST NEW SERVICE</button>
                                                      <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#diagnosis_history" class="btn btn-sm btn-danger">DIAGNOSIS HISTORY</button> -->
                                                    </div>
                                                  </div>
                                                </form>
                                                <table class="table table-responsive" id="diagnosis">
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
                                                <table class="table table-responsive" id="drugs">
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
<style>
      #diagnosis_results {
      max-height: 200px;
      overflow-y: auto;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .diagnosis-item {
      cursor: pointer;
      padding: 8px;
      background-color: #f9f9f9;
    }

    .diagnosis-item:hover {
      background-color: #f1f1f1;
    }

    #drug_results {
      max-height: 200px;
      overflow-y: auto;
      border: 1px solid #ddd;
      border-radius: 4px;
    }

    .drug-item {
      cursor: pointer;
      padding: 8px;
      background-color: #f9f9f9;
    }

    .drug-item:hover {
      background-color: #f1f1f1;
    }
</style>
          <!-- diagnosis Modal -->
          <div class="modal fade" id="add_diagnosis" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="mb-6">
                    <h4>Diagnosis (Diseases)</h4>
                  </div>
                    <div class="alert-container"></div>
                  <form id="diagnosis_form" class="row g-6" onsubmit="return false">
                    @csrf
                    <input type="text" id="opdnumber" value="{{ $attendance->opd_number }}" hidden>
                    <div id="success_diplay" class="container mt-6"></div>
                    <div class="col-12 col-md-12">
                      <label class="form-label" for="diagnosis">Search</label>
                      <input type="text" id="diagnosis" name="diagnosis" class="form-control" placeholder="Enter Diagnosis"/>
                        <div id="diagnosis_results" class="mt-2"></div>
                    </div>
                    <div class="col-12 col-md-12">
                      <label class="form-label" for="diagnosis_name">Selected Diagnosis</label>
                      <input type="text" id="diagnosis_name" name="diagnosis_name" class="form-control" disabled/>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="type">Type</label>
                      <select name="type" id="type" class="form-control" required>
                        <option value="NEW" selected>NEW</option>
                        <option value="REVIEW">REVIEW</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="category">Category</label>
                      <select name="category" id="category" class="form-control" required>
                        <option value="FINAL" selected>FINAL</option>
                        <option value="PROVISIONAL">PROVISIONAL</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="principal">Principal</label>
                     <select name="principal" id="principal" class="form-control" required>
                        <option value="YES" selected>YES</option>
                        <option value="NO">NO</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4" hidden>
                      <label class="form-label" for="icd_10">ICD-10</label>
                      <input type="text" id="icd_10" name="icd_10" class="form-control" placeholder="" disabled />
                    </div>
                    <div class="col-12 col-md-4" hidden>
                      <label class="form-label" for="gdrg_code">GDRG Code</label>
                      <input type="text" id="gdrg_code" name="gdrg_code" class="form-control" placeholder="" disabled  />
                    </div>
                    <div class="col-12 col-md-4" hidden>
                      <label class="form-label" for="diagnosis_fee">Diagnosis Fee</label>
                      <input type="text" id="diagnosis_fee" name="diagnosis_fee" class="form-control" placeholder="" disabled />
                    </div>
                   
                    <div class="col-12 col-md-6" hidden>
                      <label class="form-label" for="gdrg_code">Service G-DRG</label>
                      <input type="text" id="gdrg_code" name="gdrg_code" class="form-control"/>
                    </div>
                   
                    <div class="col-12">
                      <div class="form-check form-switch my-2 ms-2">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
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
                    <h4 class="address-title mb-2">Medication (Prescriptions)</h4>
                  </div>
                    <div class="alert-container"></div>
                  <form id="medication_form" class="row g-6" onsubmit="return false">
                    @csrf
                    <input type="text" id="opdnumber" value="{{ $attendance->opd_number }}" hidden>
                    <div id="success_diplay" class="container mt-6"></div>
                    <div class="col-12 col-md-12">
                      <label class="form-label" for="prescription_add">Search Medications</label>
                      <input type="text" id="prescription_add" name="prescription_add" class="form-control" placeholder="Enter Medication"/>
                        <div id="drug_results" class="mt-2"></div>
                    </div>
                    <div class="col-12 col-md-12">
                      <label class="form-label" for="product_name">Selected Medication</label>
                      <input type="text" id="product_name" name="product_name" class="form-control" disabled/>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="type">Dosage</label>
                      <select name="type" id="type" class="form-control" required>
                        <option value="NEW" selected>NEW</option>
                        <option value="REVIEW">REVIEW</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="category">Frequency</label>
                      <select name="category" id="category" class="form-control" required>
                        <option value="FINAL" selected>FINAL</option>
                        <option value="PROVISIONAL">PROVISIONAL</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="principal">Duration</label>
                     <select name="principal" id="principal" class="form-control" required>
                        <option value="YES" selected>YES</option>
                        <option value="NO">NO</option>
                     </select>
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="average_unit_price">ICD-10</label>
                      <input type="text" id="average_unit_price" name="average_unit_price" class="form-control" placeholder="" disabled />
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="gdrg_code">GDRG Code</label>
                      <input type="text" id="gdrg_code" name="gdrg_code" class="form-control" placeholder="" disabled  />
                    </div>
                    <div class="col-12 col-md-4">
                      <label class="form-label" for="average_unit_price">Diagnosis Fee</label>
                      <input type="text" id="average_unit_price" name="average_unit_price" class="form-control" placeholder="" disabled />
                    </div>
                    <div class="col-12 col-md-6">
                      <label class="form-label" for="gdrg_code">Service G-DRG</label>
                      <input type="text" id="gdrg_code" name="gdrg_code" class="form-control"/>
                    </div>
                    <div class="col-12">
                      <div class="form-check form-switch my-2 ms-2">
                      </div>
                    </div>
                    <div class="col-12 text-center">
                      <button type="submit" class="btn btn-primary me-3">Add</button>
                      <button type="reset" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!--/ diagnosis Modal -->
</x-app-layout>