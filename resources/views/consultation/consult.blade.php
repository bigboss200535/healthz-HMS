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
                <td colspan="2" align="center"><h5><b>Doctors</b></h5></td>
              </tr>
              <tr>
                <td rowspan="" colspan="2" align="center">
                 <img src="#x" alt="Patient Image" class="rounded-pill" style="border:1px;border-color:black; box-shadow:10px; width:50%" align="center">
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center">fullname</td>
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
                <td colspan="2"><h5><b>Patient Information</b></h5></td>
              </tr>
              <tr>
                <td><b>Folder #:</b></td>
                <td>Y082/24</td>
              </tr>
              <tr>
                <td><b>Gender:</b></td>
                <td>Male</td>
              </tr>
              <tr>
                <td><b>Age:</b></td>
                <td>43 Years</td>
              </tr>
              <tr>
                <td><b>Active Sponsor</b></td>
                <td><span class="badge bg-label-danger">Private Insurance</span></td>
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
                <td colspan="2"><h5><b>Last Visit</b></h5></td>
              </tr>
              <tr>
                <td>Last Visit</td>
                <td>24-01-2024</td>
              </tr>
              <tr>
                <td><b>Change Visit</b></td>
                <td>
                  <select name="visit_date" id="visit_date" class="form-control">
                    <option value="">-Select-</option>
                  </select>
                  <!-- <button><i class="fa fa-reload"></i></button> -->
                </td>
              </tr>
              <tr>
                <td><b>Visit Outcome</b></td>
                <td>N/A</td>
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
                  <!-- <input type="submit" name="new_visit" id="new_visit" class="btn btn-primary rounded-pill" value="Add New Visit"> -->
                  <a href="/consultation/opd-consultation" class="btn btn-primary rounded-pill">
                    <i class="fas fa-plus"></i> 
                    Consult
                  </a>
                  <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewAddress"> Show </button> -->
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
            <h4 align="center">-Kingly select a date to display attendace or Create an attendance-</h4>
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
            <table class="table table-responsive" id="product_list">
              <thead>
                <tr>
                  <th>Sn</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Ward</th>
                  <th>Bed #</th>
                  <th>Admit Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
              <tfoot>
              <tr>
                  <th>Sn</th>
                  <th>Date</th>
                  <th>Name</th>
                  <th>Gender</th>
                  <th>Age</th>
                  <th>Ward</th>
                  <th>Bed #</th>
                  <th>Admit Date</th>
                  <th>Action</th>
                </tr>
              </tfoot>

            </table>
        
            <!-- <h4 align="center">-Kingly select a date to display attendace or Create an attendance-</h4> -->
        </div>
      </div>
    </div>
  </div>
</div>

</div>        
</x-app-layout>