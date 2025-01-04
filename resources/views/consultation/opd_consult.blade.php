<x-app-layout>
<duiiv class="container-xxl flex-grow-1 container-p-y">    
        <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1 mt-3">In-patient Consultation</h4>
          <!-- <p class="text-muted">Generate Report using criteria</p> -->
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mdoal_form" >Search Patient</button>
            <button class="btn btn-primary">Go to Registered Patients</button>
            <a href="{{ url('patient/search') }}" class="btn btn-primary">Search Patient</a>
            <a href="#" class="btn btn-primary">Add Attendance</a>
            <button type="submit" class="btn btn-primary">Patient Sponsorship</button>
        </div>
      </div>
      
  <div class="row">
   <div class="col-12 col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-tile mb-0"><b>Report Information</b></h5>
        </div>
        <div class="card-body">
          <form id="patient_info" enctype="multipart/form-data" method="post">
           @csrf
          <div class="row mb-3">
            <div class="col">
              <label class="form-label" for="start_date">Start Date <a style="color: red;">*</a></label>
              <input type="date" class="form-control" id="begin_date" name="begin_date" placeholder="Start End">
            </div>
            <div class="col">
              <label class="form-label" for="end_date">End Date <a style="color: red;">*</a></label>
              <input type="date" class="form-control" id="ending_date" name="ending_date" value="" placeholder="End Date">
            </div>
            <div class="col">
              <label class="form-label" for="report_type">Report Type <a style="color: red;">*</a></label>
              <select  class="form-control" id="report_type" name="report_type">
                <option selected disabled>-Select-</option>
                <option value="users">Users</option>
                <option value="user_logs">User Logs</option>
              </select>
            </div>
            <br> <br>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-header">
            <h5 class="card-tile mb-0"><b>Waiting List</b></h5>
        </div>
        <div class="card-body">
            
        </div>
      </div>
    </div>
    <div class="d-flex align-content-center flex-wrap gap-3">
      <button type="submit" class="btn btn-primary">Generate</button>
      <button type="reset" class="btn btn-label-secondary">clear</button>
    </div>
    </form>
  </div>
</div>
</div>        
</x-app-layout>