<x-app-layout>
<div class="container-xxl flex-grow-1 container-p-y">    
          <div class="app-ecommerce">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex flex-column justify-content-center">
          <h4 class="mb-1 mt-3">NHIS Claims Management</h4>
          <p class="text-muted">Real-time claims monitoring and modifications</p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-3">
                    <button class="btn btn-primary" onclick="refreshClaims()">
                        <i class="bx bx-refresh"></i> Refresh
                    </button>
                    <a href="/export-claims" class="btn btn-success">
                        <i class="bx bx-download"></i> Export XML
                    </a>
                </div>
      </div>
  <div class="row">
   <div class="col-12 col-lg-12">
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
              <label class="form-label" for="end_date">Specialty <a style="color: red;">*</a></label>
              <select  class="form-control" id="report_type" name="report_type">
                <option selected disabled>-Select-</option>
                <!--  -->
                <!-- <option value="user_logs">User Logs</option> -->
              </select>
            </div>
            <div class="col">
              <label class="form-label" for="report_type">Claims Type <a style="color: red;">*</a></label>
              <select  class="form-control" id="report_type" name="report_type">
                <option selected disabled>-Select-</option>
                <option value="All">All</option>
                <option value="IPD">IPD</option>
                <option value="OPD">OPD</option>
                <!-- <option value="users">With Diagnosis</option>
                <option value="users">With Drugs</option>
                <option value="users">With Diagnosis and Drugs</option>
                <option value="users">Without Drugs</option>
                <option value="users">Without Diagnosis</option> -->
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
    <div class="d-flex align-content-center flex-wrap gap-3">
      <button type="submit" class="btn btn-primary" onclick="loadClaims()">Fetch Claims</button>
      <!-- <button type="reset" class="btn btn-label-secondary">clear</button> -->
    </div>
  </form>
  </div>
  <br>
  <!-- new row  -->
  <div class="row">
   <div class="col-12 col-lg-12">
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="card-tile mb-0"><b>Claims Details</b></h5>
          <br> 
              <div class="bulk-actions col-3 pull-right" >
                        <select class="form-select" id="bulkAction">
                        <option selected disabled></option>
                            <option>Vetted Selected</option>
                            <option>Unvetted Selected</option>
                            <!-- <option>Export Selected</option> -->
                        </select>
                        <button class="btn btn-outline-primary" onclick="processBulkActions()">
                            Apply
                        </button>
                    </div>
        </div>
        <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="claimsTable">
                            <thead class="table-light">
                                <tr>
                                    <th><input type="checkbox" id="selectAll"></th>
                                    <th>Claim No</th>
                                    <th>Name</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Gender</th>
                                    <th>Patient No</th>
                                    <th>Type</th>
                                    <th>Pharmacy (GHS)</th>
                                    <th>Service (GHS)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="claimsBody">
                                <!-- Dynamic content loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <div class="summary-info">
                        <span class="text-muted">Showing </span>
                        <strong><span id="visibleCount">0</span> of <span id="totalCount">2,172</span></strong>
                    </div>
                    <div class="summary-cost">
                        <span class="text-muted">Total: </span>
                        <strong>GHS <span id="totalCost">233,874.77</span></strong>
                    </div>
                </div>
      </div>
    </div>
  </div>


</div>
</div>
<!-- Loading Overlay -->
     <div id="loadingOverlay" class="loading-overlay" style="display: none;">
        <div class="spinner-border text-primary"></div>
    </div>

@push('scripts')
    <script>
        // Initialize real-time updates
        let refreshInterval = 30000; // 30 seconds
        
        // Load initial claims
        $(document).ready(function() {
            loadClaims();
            setInterval(loadClaims, refreshInterval);
        });

        // AJAX Claims Loader
        function loadClaims() {
            showLoading();
            
            $.ajax({
                url: '/claims/fetch',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    start_date: $('#start_date').val(),
                    end_date: $('#end_date').val(),
                    claim_type: $('#claim_type').val()
                },
                success: function(response) {
                    $('#claimsBody').html(response.html);
                    updateSummary(response.stats);
                },
                complete: hideLoading
            });
        }

        // Inline Editing Handler
        $(document).on('dblclick', '.editable', function() {
            const cell = $(this);
            const originalValue = cell.text().trim();
            const field = cell.data('field');
            const claimId = cell.closest('tr').data('id');

            cell.html(`
                <input type="text" 
                    class="form-control form-control-sm" 
                    value="${originalValue}"
                    data-original="${originalValue}"
                    onkeypress="handleInlineEdit(event, ${claimId}, '${field}')">
            `).find('input').focus();
        });

        // Bulk Actions Handler
        function processBulkActions() {
            const selectedIds = $('.claim-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length === 0) {
                showToast('Please select claims to perform actions', 'warning');
                return;
            }

            const action = $('#bulkAction').val();
            performBulkAction(action, selectedIds);
        }

        // Real-time Summary Updater
        function updateSummary(stats) {
            $('#visibleCount').text(stats.visible_count);
            $('#totalCount').text(stats.total_count);
            $('#totalCost').text(stats.total_cost.toLocaleString('en-US', {
                minimumFractionDigits: 2
            }));
        }

        // Helper Functions
        function showLoading() {
            $('#loadingOverlay').fadeIn(200);
        }

        function hideLoading() {
            $('#loadingOverlay').fadeOut(200);
        }

        function showToast(message, type = 'success') {
            Toastify({
                text: message,
                className: type,
                duration: 3000
            }).showToast();
        }
    </script>
    @endpush

    <style>
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }
        
        .editable {
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .editable:hover {
            background-color: #f8f9fa;
        }
        
        .bulk-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }
    </style>
</x-app-layout>