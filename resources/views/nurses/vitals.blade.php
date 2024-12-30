<x-app-layout>
    <div class="container-xxl flex-grow-1 container-p-y">    
       <h4 class="py-3 mb-4">
          <span class="text-muted fw-light">Patients /</span> Vitals Signs
        </h4>
          <div class="row">
            <div class="col-12 col-lg-6">
                <div class="card mb-4">
                  <div class="card-header">
                    <h5 class="card-tile mb-0"><b>Vital Signs</b></h5>
                  </div>
                  <div class="card-body">
                  <div class="nav-align-top nav-tabs-shadow mb-6">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                      <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-notes" aria-controls="navs-justified-home" aria-selected="true">
                          <span class="d-none d-sm-block">Add vital Signs</span>
                        </button>
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile" aria-selected="false">
                          <span class="d-none d-sm-block">History of Vitals</span>
                        </button> 
                      </li>
                      <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-justified-messages" aria-controls="navs-justified-messages" aria-selected="false">
                          <span class="d-none d-sm-block"> Admission List</span>
                        </button>
                      </li>
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-notes" role="tabpanel">
                      <p>
                        <div class="col-3">
                          <label class="form-label" for="firstname">Temperature <a style="color: red;">*</a></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="Firstname" autocomplete="off">
                            <div class="col">
                          <label class="form-label" for="firstname">Temperature <a style="color: red;">*</a></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="Firstname" autocomplete="off">
                         </div> 
                         </div> 
                         <div class="col-3">
                          <label class="form-label" for="firstname">Temperature <a style="color: red;">*</a></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="Firstname" autocomplete="off">
                         </div>
                         <div class="col-3">
                          <label class="form-label" for="firstname">Temperature <a style="color: red;">*</a></label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="" placeholder="Firstname" autocomplete="off">
                         </div>    
                      </p>
                  </div>
                  <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                    <p>
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
                    </p>
                  </div>
                      <div class="tab-pane fade" id="navs-justified-messages" role="tabpanel">
                        <p>
                            <ul class="timeline mb-0">
                                    <li class="timeline-item timeline-item-transparent">
                                      <span class="timeline-point timeline-point-primary"></span>
                                      <div class="timeline-event">
                                        <div class="timeline-header mb-3">
                                          <h6 class="mb-0">DOCTOR: MOHAMMED ALHASSAN </h6>
                                          <!-- <small class="text-muted">25/12/2024   11:59AM</small> -->
                                        </div>
                                        <p class="mb-2" style="color: #000000;">
                                          <b>MALARIA</b> | B54  | OPDC06A   | 25/12/2024 
                                          <!-- <a href="#"><i class="bx bx-edit"></i></a> -->
                                        </p>
                                        <p class="mb-2" style="color: #000000;">
                                          <b>ANAEMIA</b> | D50  | OPDC06A   | 25/12/2024 
                                          <!-- <a href="#"><i class="bx bx-edit"></i></a> -->
                                        </p>
                                        
                                      </div>
                                    </li>
                              </ul>
                        </p>
                      </div>
                </div>
              </div>
            </div>
            </div>
            </div>
              <div class="col-12 col-lg-6">
                <div class="card mb-4">
                  <div class="card-body">
                  <div class="card-header">
                    <h5 class="card-tile mb-0"><b>Patient List</b></h5>
                  </div>
                      <table class="table table-responsive" id="nurses_notes_patient">
                        <thead>
                          <tr>
                            <th>Sn</th>
                            <th>Opd Number</th>
                            <th>Patient Name</th>
                            <th>Clinic</th>
                            <!-- <th>Bed No</th> -->
                            <th>Vital</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                        <tr>
                            <th>Sn</th>
                            <th>Opd Number</th>
                            <th>Patient Name</th>
                            <th>Clinic</th>
                            <!-- <th>Bed No</th> -->
                            <th>Vital</th>
                            <th></th>
                          </tr>
                        </tfoot>
                      </table>
                  </div>
                </div>
              </div>
              <!-- <div class="d-flex align-content-center flex-wrap gap-3">
                <button type="submit" class="btn btn-primary">Generate</button>
                <button type="reset" class="btn btn-label-secondary">clear</button>
              </div> -->
            </div>
          </div>
    </div>           
</x-app-layout>