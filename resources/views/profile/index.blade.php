<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        </div>
  <div class="row">
   <div class="col-12 col-lg-8">
    <div class="nav-align-top nav-tabs-shadow mb-6">
      <ul class="nav nav-tabs nav-fill" role="tablist">
        <li class="nav-item">
          <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#nav_home" aria-controls="navs-justified-home" aria-selected="true">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i> 
              User Infomation
            </span>
            <i class="bx bx-home bx-sm d-sm-none"></i>
          </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_sponsor" aria-controls="navs-justified-profile" aria-selected="false">
              <span class="d-none d-sm-block">
                <i class="tf-icons bx bx-money-withdraw bx-sm me-1_5 align-text-bottom"></i> 
                User Logs
              </span>
              <i class="bx bx-user bx-sm d-sm-none"></i>
            </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_attendance" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-timer bx-sm me-1_5 align-text-bottom"></i> Activity History
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li>
        <li class="nav-item">
          <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#nav_medications" aria-controls="navs-justified-messages" aria-selected="false">
            <span class="d-none d-sm-block">
              <i class="tf-icons bx bx-time bx-sm me-1_5 align-text-bottom"></i> Appointments
            </span>
            <i class="bx bx-message-square bx-sm d-sm-none"></i>
          </button>
        </li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane fade show active" id="nav_home" role="tabpanel">
          <p>
              <!-- <div class="card-header">
                  <h5 class="card-tile mb-0 text-primary"><b>BIO-INFORMATION</b></h5>
              </div> -->
                <table class="table">
                    <tr>
                       <td colspan="2">
                          <h5 class="text-dark"><b>BIO-INFORMATION</b></h5>
                       </td>
                    </tr>
                    <tr>
                      <td><b>Fullname</b></td>
                      <td>{{ strtoupper($user->user_fullname) }}</td>
                    </tr>
                    <tr>
                      <td><b>Gender</b></td>
                      <td>{{ strtoupper($user->gender) }}</td>
                    </tr>
                    <tr>
                      <td><b>Access Level</b></td>
                      <td>{{ strtoupper($user->role_id) }}</td>
                    </tr>
                    <tr>
                        <td><b>Email</b></td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td><b>Telephone</b></td>
                        <td>{{ $user->telephone }}</td>
                    </tr>
                    <tr>
                      <td><b>Date Registered</b>:</td>
                      <td>{{ \Carbon\Carbon::parse($user->added_date)->format('d-m-Y') }}</td>
                    </tr>
                      
                    </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_sponsor" role="tabpanel">
          <p>
            <div>
              <h5>User Logs</h5>
                <!-- <div class="pull-right">
                    <a href="#" class="btn btn-info pull-right" id="clear_search">Add Sponsor</a>
                </div> -->
            </div>
            <table class="table table-hover" id="patient_sponsor">
              <thead>
                <tr>
                  <th>Sponsor Type</th>
                  <th>Member #</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Sponsorhip Status</th>
                  <th>Prority Sponsor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                     
              </tbody>
              <tfoot>
                <tr>
                <th>Sponsor Type</th>
                  <th>Member #</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Sponsorhip Status</th>
                  <th>Prority Sponsor</th>
                  <th>Action</th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_attendance" role="tabpanel">
        <p>
            <div>
              <h5>Activity History</h5>
            </div>
            <table class="table table-hover" id="attendance_details">
              <thead>
                <tr>
                  <th>Sn #</th>
                  <th>Attendance Date</th>
                  <th>Patient Age</th>
                  <th>Clinic</th>
                  <th>Sponsor</th>
                  <th>Status</th>
                  <!-- <th>is NHIS</th> -->
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                            
             </tbody>
              <tfoot>
                <tr>
                  <th>Sn #</th>
                  <th>Attendance Date</th>
                  <th>Patient Age</th>
                  <th>Clinic</th>
                  <th>Sponsor</th>
                  <th>Status</th>
                  <!-- <th>is NHIS</th> -->
                  <th>Status</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
        <div class="tab-pane fade" id="nav_medications" role="tabpanel">
        <p>
            <div>
              <h5>Appointments History</h5>
            </div>
            <table class="table table-hover" id="appointments">
              <thead>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>S/N</th>
                  <th>Type</th>
                  <th>Member #</th>
                  <th>Effect Date</th>
                  <th>Expiry Date</th>
                  <th># Status</th>
                  <th>Active?</th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </p>
        </div>
       
        
       
      </div>
    </div>
  </div>
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row mb 3">
                <!-- <h5 class="card-tile mb-0"><b>Sponsorship Details</b></h5> -->
          </div>
           <div class="mb-3 col ecommerce-select2-dropdown" align="center">
            <img src="{{ $user->gender==='FEMALE' ? asset('img/avatars/female.jpg') : asset('img/avatars/male.jpg') }}" alt="Patient Image" class="rounded-pill" style="border:1px;border-color:black; box-shadow:10px ">
          </div>
          <div class="mb-3 col ecommerce-select2-dropdown" align="center">
            <h5 class="card-tile mb-0"><b> {{ $user->fullname }}</b></h5>
          </div>
          <div class="mb-3 col ecommerce-select2-dropdown">
           <table class="table">
            
            <tr>
              <td><b>Date Registered</b>:</td>
              <td>{{ \Carbon\Carbon::parse($user->added_date)->format('d-m-Y') }}</td>
            </tr>
            <tr>
              <td><b>Blood Group</b>:</td>
              <td><span class="badge bg-label-info me-1">AB-</span></td>
            </tr>
            <tr>
              <td><b>Verfified Telephone</b>:</td>
              <td><span class="badge bg-label-danger me-1"><i class="fa fa-times"></i></span></td>
            </tr>
            <!-- <tr>
              <td><b>Member #</b>:</td>
              <td><span class="badge bg-label-danger me-1"> UNAVAILABLE</span></td>
            </tr> -->
            <tr>
              <td colspan="2" align="center">
                <!-- <div class="btn-group"> -->
                        <button type="button" class="btn btn btn-info">CHANGE PASSWORD</button>
                        <button type="button" class="btn btn btn-warning">EDIT DETAILS</button>
                        <!-- <button type="button" data-bs-toggle='modal' data-bs-target="#addattendance" class="btn btn-sm btn-primary">NEW ATTENDANCE</button> -->
                <!-- </div> -->
              </td>
                
            </tr>
           </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
      
</div>   

</x-app-layout>