<x-app-layout>
<duiiv class="container-xxl flex-grow-1 container-p-y">    
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1 mt-3">Private Insurance Claims Management</h4>
          <p class="text-muted">Generate data using criteria below</p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
          <!-- <button class="btn btn-primary">E-Claims</button> -->
          <!-- <a href="#" class="btn btn-primary"><i class="menu-icon tf-icons bx bx-refresh"></i> Generate Claim IT </a> -->
        </div>
      </div>
  <div class="row">
   <div class="col-12 col-lg-8">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-tile mb-0"><b>Claims Infomation</b></h5>
        </div>
        <div class="card-body">
          <form id="patient_info" enctype="multipart/form-data" method="post">
           @csrf
           <!------------------------>
          <div class="row mb-3">
            <div class="col">
              <label class="form-label" for="start_date">Start Date <a style="color: red;">*</a></label>
              <input type="date" class="form-control" id="begin_date" name="begin_date" placeholder="Start End">
            </div>
            <div class="col">
              <label class="form-label" for="end_date">Company <a style="color: red;">*</a></label>
              <select  class="form-control" id="report_type" name="report_type">
                <option selected disabled>-Select-</option>
                <!--  -->
                <!-- <option value="user_logs">User Logs</option> -->
              </select>
            </div>
            <div class="col">
              <label class="form-label" for="report_type">Claims Criteria <a style="color: red;">*</a></label>
              <select  class="form-control" id="report_type" name="report_type">
                <option selected disabled>-Select-</option>
                <option value="users">With Diagnosis</option>
                <option value="users">With Drugs</option>
                <option value="users">With Diagnosis and Drugs</option>
                <option value="users">Without Drugs</option>
                <option value="users">Without Diagnosis</option>
                <!-- <option value="user_logs">User Logs</option> -->
              </select>
            </div>
          </div>
          <!------------------------->
          <div class="row mb-3">
            <div class="col">
              <label class="form-label" for="start_date">End Date <a style="color: red;">*</a></label>
              <input type="date" class="form-control" id="begin_date" name="begin_date" placeholder="Start End">
            </div>
            <div class="col">
              <label class="form-label" for="end_date">No of Claims <a style="color: red;">*</a></label>
              <input type="number" class="form-control" id="ending_date" name="ending_date">
            </div>
            <div class="col">
              <label class="form-label" for="report_type">Report Type <a style="color: red;">*</a></label>
              <select  class="form-control" id="report_type" name="report_type">
                <option selected disabled>-Select-</option>
                <option value="users">All</option>
                <option value="users">Vetted</option>
                <option value="user_logs">Unvetted</option>
              </select>
            </div>
          </div>
          <!-------------------------->
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-body">
            <img src="{{ asset('img/undraw/private_claims.svg') }}" alt="" height="210px">
            <br>
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