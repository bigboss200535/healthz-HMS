<x-app-layout>
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                             <h3 class="card-title text-primary"> 
                               {!! $greeting !!}, {{ Auth::user()->othername }}</h3>
                          <p class="mb-4">
                           <!-- <marquee behavior="" direction="">"The way to get started is to quit talking and begin doing."</marquee> -->
                           "The way to get started is to quit talking and begin doing."
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
                <!-- <br> -->
                <!-- Hour chart  -->
                <div class="card bg-transparent shadow-none my-6 border-0">
                  <div class="card-body row p-0 pb-6 g-6">
                    <div class="col-12 col-lg-10 card-separator">
                      <h5 class="mb-2">

                      </h5>
                      <div class="col-12 col-lg-12">
                        <p>
                          Your progress this week is Awesome. Let's keep it up and get a lot of points reward !
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
                            <h4 class="text-primary mb-0">{{ $out_patient ?? 0 }}</h4>
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
                            <h4 class="text-info mb-0">{{ $in_patient ?? 0 }}</h4>
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
                            <h4 class="text-warning mb-0">{{ $appointments  }}</h4>
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
                            <h4 class="text-warning mb-0">0</h4>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-12 col-lg-2 ps-md-4 ps-lg-6">
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
                </div>
                <!-- Hour chart End  -->
            <!-- <br> -->
                <div class="card">
                  <div class="card-body">
                      <h3>Menu</h3>
                        <div class="card" style="border-color: black; border-width:2px">
                        <div class="card-body text-center">
                          <div >
                              <a href="{{ route('patients.index') }}" class="btn btn-dark"><i class="bx bx-search"></i>Search Patient</a>
                              <a href="{{ route('patients.create') }}" class="btn btn-info"><i class="bx bx-plus"></i>Register New Patient</a>
                              <a href="{{ url('patient/add-appointment') }}" class="btn btn-dark"><i class="bx bx-plus"></i>Book Appointment</a>
                              <a href="#" class="btn btn-info"><i class="menu-icon tf-icons bx bx-injection"></i>Walk-in Medications</a>
                              <a href="#" class="btn btn-dark"><i class="menu-icon tf-icons bx bx-male-female"></i>Walk-In Services</a>
                          </div>
                      </div>
                        </div>
                  </div>
                </div>
            </div>
    </x-app-layout>