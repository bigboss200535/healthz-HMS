<x-app-layout>
<duiiv class="container-xxl flex-grow-1 container-p-y">    
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1 mt-3">System Notifications</h4>
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
          <h5 class="card-tile mb-0"><b>Notifications Infomation</b></h5>
        </div>
        <div class="card-body">
            <table class="table table-responsive" id="product_list">
                <thead>
                    <tr>
                        <th>Sn</th>
                        <th>Notification</th>
                        <th>Added Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                     @php
                       $counter = 1;
                     @endphp
                    @foreach($notifications as $notify)
                <tbody>
                    <tr>
                     <td>{{ $counter++ }}</td>
                     <td>
                        <span class="short-text">{{ Str::limit($notify->notification, 50) }}</span>
 
                     </td>
                     <td>{{ $notify->added_date }}</td>
                     <td>@if($notify->status === 'Active')
                            <span class="badge bg-label-info me-1">Unread</span>
                                @elseif ($notify->status === 'No')
                            <span class="badge bg-label-danger me-1">Read</span>
                        @endif
                    </td>
                     <td>
                              <div class="dropdown" align="center">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                      <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                        <div class="dropdown-menu">
                                                <a class="dropdown-item" href="">
                                                    <i class="bx bx-edit-alt me-1"></i> Read
                                                </a>
                                               
                                        </div>
                                </div> 
                     </td>
                    </tr>
                </tbody>
                @endforeach
                <tfoot>
                        <th>Sn</th>
                        <th>Notification</th>
                        <th>Added Date</th>
                        <th>Status</th>
                        <th>Action</th>
                </tfoot>
            </table>
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-4">
      <div class="card mb-4">
        <div class="card-body">
            <img src="{{ asset('img/undraw/nhis_claims.svg') }}" alt="" height="210px">
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