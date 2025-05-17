<x-app-layout> 
<div class="container-xxl flex-grow-1 container-p-y">   
    <div class="card">
        <div class="card-header">
            <h4>Patient Reports</h4>
        </div>
        <div class="card-body">
            <div id="errorContainer" style="display: none;"></div>
             <form id="patientReportForm" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="gender_id">Gender</label>
                            <select name="gender_id" id="gender_id" class="form-control">
                                <option value="">ALL GENDERS</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="religion_id">Religion</label>
                            <select name="religion_id" id="religion_id" class="form-control">
                                <option value="">ALL RELIGION</option>
                                @foreach($religions as $religion)
                                    <option value="{{ $religion->religion_id }}">{{ strtoupper($religion->religion) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="sponsor_id">Sponsor</label>
                            <select name="sponsor_id" id="sponsor_id" class="form-control">
                                <option value="" selected>ALL SPONSORS</option>
                                @foreach($sponsors as $sponsor)
                                    <option value="{{ $sponsor->sponsor_id }}">{{ $sponsor->sponsor_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                         <div class="form-group mb-3">
                            <label for="sponsor_type_id">Sponsor Type</label>
                            <select name="sponsor_type_id" id="sponsor_type_id" class="form-control">
                                <option value="">ALL SPONSOR TYPES</option>
                                @foreach($sponsor_types as $type)
                                    <option value="{{ $type->sponsor_type_id }}">{{ $type->sponsor_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="report_type">Report Type</label>
                            <select name="report_type" id="report_type" class="form-control">
                                <option disabled selected>-Select-</option>
                                <option value="View">View Report</option>
                                <option value="PDF">Download PDF</option>
                                <option value="Excel">Download Excel</option>
                                <option value="Word">Download Word</option>
                               
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date_from">Date From</label>
                            <input type="date" name="date_from" id="date_from" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date_to">Date To</label>
                            <input type="date" name="date_to" id="date_to" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <!-- <label>Report Format</label> -->
                    <div class="d-flex gap-2">
                        <button type="submit" name="action" id="view" value="view" class="btn btn-primary">
                           Submit
                        </button>
                        <!-- <button type="submit" name="action" value="pdf" class="btn btn-danger">
                            <i class="bx bx-pdf"></i> Download PDF
                        </button>
                        <button type="submit" name="action" value="excel" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Download Excel
                        </button>
                        <button type="submit" name="action" value="word" class="btn btn-info">
                            <i class="fas fa-file-word"></i> Download Word
                        </button>
                        <button type="submit" name="action" value="print" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Print
                        </button> -->
                        <!-- Add the missing reset button -->
                        <!-- <button type="button" id="resetButton" class="btn btn-outline-secondary">
                            <i class="fas fa-redo"></i> Reset -->
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {

        const viewButton = document.getElementById('view');
        const originalButtonText = viewButton.innerHTML;
        viewButton.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Searching...';
        viewButton.disabled = true;

        // Handle form submission
        $("#patientReportForm").on('submit', function(e) {
            e.preventDefault();
        
            var formData = $(this).serialize();
            // Capture the action value from the clicked button
            var action = $(document.activeElement).val();
            
            // Show loading indicator
            $("#loadingIndicator").show();
            
            $.ajax({
                url: '{{ route("reports.patients.generate") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                        // $restBtn.prop('disabled', true);
                        $viewButton.prop('disabled', true)
                        .html('<span class="spinner-border spinner-border-sm" role="status"></span> Submitting...');
                    },
                success: function(response) {
                    if (response.code === 201) {
                            // toastr.success(response.message || 'Patient saved successfully');
                            // $form[0].reset();
                            // $('#pat_id').val('');
                            // $('.is-invalid').removeClass('is-invalid');
                            $viewButton.prop('disabled', false);
                            // $restBtn.prop('disabled', false);
                        }else if (response.code === 200) {
                            // toastr.warning('Patient data already exists');
                            $viewButton.prop('disabled', false);
                            // $restBtn.prop('disabled', false);
                        }
                },
                error: function(xhr, status, error) {
                    // $("#loadingIndicator").hide();
                    
                    // Display error message
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred while processing your request.';
                    $("#errorContainer").html('<div class="alert alert-danger">' + errorMessage + '</div>');
                    $("#errorContainer").show();
                }
            });
        });
        
        // Reset form and clear results
        $("#resetButton").on('click', function() {
            // $("#patientReportForm")[0].reset();
            // $("#resultsContainer").hide();
            // $("#errorContainer").hide();
        });
    });
</script>
</x-app-layout>