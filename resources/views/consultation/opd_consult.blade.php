<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
    <!-- Invoice List Widget -->
<div class="card mb-6">
  <div class="card-widget-separator-wrapper">
    <div class="card-body card-widget-separator">
      <div class="row gy-4 gy-sm-1">
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-center card-widget-1 border-end pb-4 pb-sm-0">
           
            <p>
           <table class="table table-striped">
              <tr>
                <td colspan="2" align="center"><h5><b>Patient Details</b></h5></td>
              </tr>
              <tr>
             
          
                <td rowspan="" colspan="2" align="center">
                 <img src="{{ $attendance->gender==='FEMALE' ? asset('img/avatars/female.jpg') : asset('img/avatars/male.jpg') }}" 
                 alt="Patient Image" class="rounded-pill" style="border:1px;border-color:black; box-shadow:10px; width:50%" 
                 align="center">
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">{{ $attendance->fullname}}</td>
              </tr>
            </table>
           </p>
          </div>
          <hr class="d-none d-sm-block d-lg-none me-6">
        </div>
        <div class="col-sm-6 col-lg-3">
          <div class="d-flex justify-content-between align-items-center card-widget-2 border-end pb-4 pb-sm-0">
            
           <p>
           <table class="table table-hover">
              <tr>
                <!-- <td colspan="2"><h5><b>Patient Information</b></h5></td> -->
              </tr>
              <tr>
                <td><b>OPD #:</b></td>
                <td>{{ $attendance->opd_number}}</td>
              </tr>
              <tr>
                <td><b>Gender:</b></td>
                <td>{{ $attendance->gender}}</td>
              </tr>
              <tr>
                <td><b>Age:</b></td>
                <td>{{ $attendance->full_age}}</td>
              </tr>
              <tr>
                <td><b>Sponsor Type:</b></td>
                <td><span class="badge bg-label-danger">{{ $attendance->sponsor_type}}</span></td>
              </tr>
              <tr>
                <td><b>Sponsor:</b></td>
                <td><span class="badge bg-label-primary">{{ $attendance->sponsor}}</span></td>
              </tr>
            </table>
           </p>
          </div>
          <hr class="d-none d-sm-block d-lg-none me-6">
        </div>
        <div class="col-sm-6 col-lg-4">
          <div class="d-flex justify-content-between align-items-center border-end pb-4 pb-sm-0 card-widget-3">
          <p>
           <table class="table table-hover">
              <tr>
                <!-- <td colspan="2"><h5><b>Last Visit</b></h5></td> -->
              </tr>
              <tr>
                <td><b>Last Visit</b></td>
                <td>24-01-2024</td>
              </tr>
              <tr>
                <td><b>Consulting Room</b></td>
                <td>
                  <select name="visit_date" id="visit_date" class="form-control">
                    <option disabled selected>-Select-</option>
                           @foreach($con_room as $consulting_room)                                        
                              <option value="{{ $consulting_room->consulting_room_id}}">{{ $consulting_room->consulting_room }}</option>
                           @endforeach
                  </select>
                  <!-- <button><i class="fa fa-reload"></i></button> -->
                </td>
              </tr>
              <tr>
                <td><b>Visit Outcome</b></td>
                <td>
                  <select name="visit_date" id="visit_date" class="form-control">
                    <option selected disabled>-Select-</option> 
                    <option value="">Discharged Successfully</option>
                    <option value="">Recommend for Admission</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td><b>Doctor</b></td>
                <td>
                  <select name="doctors" id="doctors" class="form-control">
                    <option value="" selected selected>-Select-</option>
                        @foreach($doctors as $doc)                                        
                              <option value="{{ $doc->user_id}}">{{ $doc->title. ' '. $doc->user_fullname }}</option>
                           @endforeach
                  </select>
                </td>
              </tr>
            </table>
           </p>
          </div>
        </div>
        <div class="col-sm-6 col-lg-2">
          <div class="d-flex justify-content-between align-items-center">
            <p>
            <table>
              <tr>
                <td><h5><b>Waiting List</h5></b></td>
              </tr>
              <tr>
                <td>
                 
                </td>
              </tr>
              <tr>
                <td>
                   <!-- <input type="submit" name="new_visit" id="new_visit" class="btn btn-secondary rounded-pill" value="Gen E-folder"> -->
                </td>
              </tr>
              <tr>
                 <td>
                   <!-- <input type="submit" name="new_visit" id="new_visit" class="btn btn-primary rounded-pill" value="E-folder"> -->
                </td>
              </tr>
              <!-- <tr>
                <td><b>Sponsor</b></td>
                <td><span class="badge bg-label-primary">Nhis</span></td>
              </tr> -->
            </table>
            </p>
            <!-- <div>
              <h4 class="mb-0">876</h4>
              <p class="mb-0">Unpaid</p>
            </div> -->
            <!-- <div class="avatar">
              <span class="avatar-initial rounded bg-label-secondary text-heading">
                <i class="bx bx-error-circle bx-26px"></i>
              </span>
            </div> -->
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
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-vitals" aria-controls="navs-justified-home" aria-selected="true">
                                  <span class="d-none d-sm-block"><b>Vital Signs</b></span>
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-presenting" aria-controls="navs-justified-home" aria-selected="true">
                                  <span class="d-none d-sm-block"><b>Clinical Notes</b></span>
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-requests" aria-controls="navs-justified-profile" aria-selected="false">
                                  <span class="d-none d-sm-block"><b>History/Medical Conditions</b></span>
                                </button> 
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-systems" aria-controls="navs-justified-messages" aria-selected="false">
                                  <span class="d-none d-sm-block"><b>Review of Systems</b> </span>
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-diagnosis" aria-controls="navs-justified-messages" aria-selected="false">
                                  <span class="d-none d-sm-block"> <b>Diagnosis/Prescriptions</b></span>
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-diagnosis" aria-controls="navs-justified-messages" aria-selected="false">
                                  <span class="d-none d-sm-block"> <b>Document</b></span>
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-diagnosis" aria-controls="navs-justified-messages" aria-selected="false">
                                  <span class="d-none d-sm-block"> <b>Investigations</b></span>
                                </button>
                              </li>
                              <li class="nav-item">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-diagnosis" aria-controls="navs-justified-messages" aria-selected="false">
                                  <span class="d-none d-sm-block"> <b>E-Folder</b></span>
                                </button>
                              </li>
                            </ul>
                  
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="navs-vitals" role="tabpanel">
                              <h4 class="py-3 mb-4">
                                <span class="text-muted fw-light"><b>Vital Signs</b></span>
                              </h4>
                               <table class="table table-striped" id="product_list">
                                <thead>
                                  <tr>
                                    <th>SN</th>
                                    <th>Date</th>
                                    <th>Temperature</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Blood Pressure</th>
                                    <th>Pulse</th>
                                    <th>BMI</th>
                                    <th>Respiratory Rate</th>
                                    <th>SpO2</th>
                                    <th>Stool</th>
                                    <th>Remarks</th>
                                  </tr>
                                </thead>
                                <tr>
                                  <td>1</td>
                                  <td></td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                  <td>1</td>
                                </tr>
                                <tfoot>
                                <tr>
                                    <th>SN</th>
                                    <th>Date</th>
                                    <th>Temperature</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Blood Pressure</th>
                                    <th>Pulse</th>
                                    <th>BMI</th>
                                    <th>Respiratory Rate</th>
                                    <th>SpO2</th>
                                    <th>Stool</th>
                                    <th>Remarks</th>
                                  </tr>
                                </tfoot>
                               </table>

                               <br>
                               <p>
                                  <label for="notes_time"><b>Vital Signs</b></label>
                                  <!-- <input type="time" class="form-control" name="notes_time" id="notes_time"> -->
                                </p>
                                <!-- <p>
                                    <a href="#" class="btn btn-primary">Submit</a>
                                </p> -->
                            </div>
                            <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                              <!-- <p>
                                      <ul class="timeline mb-0">
                                          <li class="timeline-item timeline-item-transparent">
                                            <span class="timeline-point timeline-point-primary"></span>
                                            <div class="timeline-event">
                                              <div class="timeline-header mb-3">
                                                <h6 class="mb-0">NURSE: MOHAMMED ALHASSAN </h6>
                                                <small class="text-muted">25/12/2024   11:59AM</small>
                                              </div>
                                              <p class="mb-2" style="color: #000000;">
                                                Invoices have been paid to the company 
                                                I hate hospitals but all of the staff that helped me today were so helpfully and seemed genuinely concern.
                                                I hate hospitals but all of the staff that helped me today were so helpfully and seemed genuinely concern.
                                                <a href="#"><i class="bx bx-edit"></i></a>
                                              </p>
                                            </div>
                                          </li>
                                        </ul>
                                 </p> -->
                              </div>
                                <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                                  <!-- <p>
                                      <ul class="timeline mb-0">
                                              <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point timeline-point-primary"></span>
                                                <div class="timeline-event">
                                                  <div class="timeline-header mb-3">
                                                    <h6 class="mb-0">DOCTOR: MOHAMMED ALHASSAN </h6>
                                                    
                                                  </div>
                                                  <p class="mb-2" style="color: #000000;">
                                                    <b>MALARIA</b>  <span class="badge bg-label-info me-1">B54</span><span class="badge bg-label-danger me-1">OPDC06A</span> 25/12/2024 
                                                    <a href="#"><i class="bx bx-edit"></i></a>
                                                  </p>
                                                  <p class="mb-2" style="color: #000000;">
                                                    <b>ANAEMIA</b> <span class="badge bg-label-info me-1">D50</span> <span class="badge bg-label-danger me-1">OPDC06A</span> 25/12/2024 
                                                    <a href="#"><i class="bx bx-edit"></i></a> 
                                                  </p>
                                                  
                                                </div>
                                              </li>
                                        </ul>
                                   </p> -->
                                </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>        
</x-app-layout>