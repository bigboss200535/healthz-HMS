<x-app-layout>
            <div class="container-xxl flex-grow-1 container-p-y">
              <!-- Hour chart  -->
                <!-- <div class="card bg-transparent shadow-none my-6 border-0">
                  <div class="card-body row p-0 pb-6 g-6">
                    <div class="col-12 col-lg-8 card-separator">
                      <h5 class="mb-2">
                        {!! $greeting !!}, {{ Auth::user()->othername }}
                      </h5>
                      <div class="col-12 col-lg-5">
                        <p>
                          Your progress this week is Awesome. let's keep it up and get a lot of points reward !
                        </p>
                      </div>
                      <div class="d-flex justify-content-between flex-wrap gap-4 me-12">
                        <div class="d-flex align-items-center gap-4 me-6 me-sm-0">
                          <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-primary rounded">
                              <div>
                               
                              </div>
                            </div>
                          </div>
                          <div class="content-right">
                            <p class="mb-0 fw-medium">Out Patient</p>
                            <h4 class="text-primary mb-0">34</h4>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                          <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-info rounded">
                              <div>
                          
                              </div>
                            </div>
                          </div>
                          <div class="content-right">
                            <p class="mb-0 fw-medium">In-Patient</p>
                            <h4 class="text-info mb-0">82</h4>
                          </div>
                        </div>
                        <div class="d-flex align-items-center gap-4">
                          <div class="avatar avatar-lg">
                            <div class="avatar-initial bg-label-warning rounded">
                              <div>
                               
                              </div>
                            </div>
                          </div>
                          <div class="content-right">
                            <p class="mb-0 fw-medium">Appointments </p>
                            <h4 class="text-warning mb-0">14</h4>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-lg-4 ps-md-4 ps-lg-6">
                      <div class="d-flex justify-content-between align-items-center">
                        <div>
                          <div>
                            <h5 class="mb-1">Time Spendings</h5>
                            <p class="mb-9">Weekly report</p>
                          </div>
                          <div class="time-spending-chart">
                            <h4 class="mb-2">231<span class="text-body">h</span> 14<span class="text-body">m</span></h4>
                           
                          </div>
                        </div>
                        <div id="leadsReportChart"></div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Hour chart End  -->
            <br>
              <div class="row">
                <div class="col-lg-8 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                             <h3 class="card-title text-primary"> 
                               {!! $greeting !!}, {{ Auth::user()->othername }}</h3>
                          <p class="mb-4">
                           The way to get started is to quit talking and begin doing.
                          </p>
                          <!-- <a href="{{ url('profile-details') }}" class="btn btn-sm btn-outline-primary">View Profile</a> -->
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{ asset('img/illustrations/man-with-laptop-light.png') }}"
                            height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img src="{{ asset('img/icons/unicons/chart-success.png') }}" alt="chart success"
                                class="rounded" /> 
                              </div>
                          </div>
                          <span class="fw-medium d-block mb-1">Admissions</span>
                             <h3 class="card-title mb-2">{{ $in_patient }}</h3>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <!-- <i class="bx bx-hotel"></i> -->
                              <img src="{{ asset('img/icons/unicons/chart-success.png') }}" alt="chart success" class="rounded" /> 
                              </div>
                          </div>
                          <span class="fw-medium d-block mb-1">Out Patient</span>
                             <h3 class="card-title mb-2">{{ $out_patient}}</h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="card">
                  input
                </div>
              </div> -->
                <!-- <div class="card">
                    <div class="card-body">
                      <div align="center">
                        
                      </div>
                    </div>
                </div> -->
                <br>
                <div class="card">
                  <div class="card-body">
                      <h3>Actions</h3>
                        <div class="card">
                        <div class="card-body">
                          <div align="center">
                              <a href="{{ route('patients.index') }}" class="btn btn-secondary">Search Patient</a>
                              <a href="{{ route('patients.create') }}" class="btn btn-warning">Register New Patient</a>
                              <a href="#" class="btn btn-primary">Book Appointment</a>
                              <a href="#" class="btn btn-info">Walk-in Medications</a>
                              <a href="#" class="btn btn-primary">Walk-In Services</a>
                          </div>
                      </div>
                        </div>
                  </div>
                </div>
            </div>
    </x-app-layout>