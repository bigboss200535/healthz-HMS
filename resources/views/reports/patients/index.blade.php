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
                    <div class="col-md-4">
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
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="clinic_id">Clinic</label>
                            <select name="clinic_id" id="clinic_id" class="form-control">
                                <option value="">ALL CLINICS</option>
                                @foreach($clinics as $clinic)
                                    <option value="{{ $clinic->clinic_id }}">{{ $clinic->clinic }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="report_type">Report Type</label>
                            <select name="report_type" id="report_type" class="form-control">
                                <option value="View" selected>View Report</option>
                                <option value="PDF">Download PDF</option>
                                <option value="Excel">Download Excel</option>
                                <option value="Word">Download Word</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="date_from">Date From</label>
                            <input type="date" name="date_from" id="date_from" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label for="date_to">Date To</label>
                            <input type="date" name="date_to" id="date_to" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <div class="d-flex gap-2">
                        <button type="submit" id="searchButton" class="btn btn-primary">
                           <i class="bx bx-search"></i> Search
                        </button>
                        <button type="button" id="resetButton" class="btn btn-outline-secondary">
                            <i class="bx bx-reset"></i> Reset
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Results Container -->
    <div class="card mt-4" id="resultsContainer" style="display: none;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Search Results</h5>
            <div>
                <button id="exportPdfBtn" class="btn btn-sm btn-danger">
                    <i class="bx bxs-file-pdf"></i> PDF
                </button>
                <button id="exportExcelBtn" class="btn btn-sm btn-success">
                    <i class="bx bxs-file-export"></i> Excel
                </button>
                <button id="exportWordBtn" class="btn btn-sm btn-info">
                    <i class="bx bxs-file-doc"></i> Word
                </button>
                <button id="printBtn" class="btn btn-sm btn-secondary">
                    <i class="bx bx-printer"></i> Print
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="patientsTable">
                    <thead>
                        <tr>
                            <th>OPD Number</th>
                            <th>Patient Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Religion</th>
                            <th>Telephone</th>
                            <th>Sponsor</th>
                            <th>Date Added</th>
                        </tr>
                    </thead>
                    <tbody id="patientsTableBody">
                        <!-- Results will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle form submission
        $("#patientReportForm").on('submit', function(e) {
            e.preventDefault();
            
            var formData = $(this).serialize();
            var reportType = $("#report_type").val();
            
            // If report type is not View, submit the form normally for download
            if (reportType !== 'View') {
                // Create a form and submit it to handle file downloads
                var downloadForm = $('<form>', {
                    'method': 'post',
                    'action': '{{ route("reports.patients.generate") }}'
                }).append(
                    $('<input>', {
                        'type': 'hidden',
                        'name': '_token',
                        'value': $('meta[name="csrf-token"]').attr('content')
                    })
                );
                
                // Add all form fields to the download form
                $(this).find('select, input').each(function() {
                    var input = $(this);
                    downloadForm.append(
                        $('<input>', {
                            'type': 'hidden',
                            'name': input.attr('name'),
                            'value': input.val()
                        })
                    );
                });
                
                $('body').append(downloadForm);
                downloadForm.submit();
                downloadForm.remove();
                return;
            }
            
            // Show loading state
            const searchButton = $("#searchButton");
            const originalButtonText = searchButton.html();
            searchButton.html('<i class="bx bx-loader-alt bx-spin"></i> Searching...');
            searchButton.prop('disabled', true);
            
            // Hide any previous error messages
            $("#errorContainer").hide();
            
            // Make AJAX request
            $.ajax({
                url: '{{ route("reports.patients.generate") }}',
                type: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Reset button state
                    searchButton.html(originalButtonText);
                    searchButton.prop('disabled', false);
                    
                    if (response.success) {
                        // Display results
                        displayResults(response.data);
                    } else {
                        // Show error message
                        $("#errorContainer").html('<div class="alert alert-warning">' + (response.message || 'No patients found matching your criteria.') + '</div>');
                        $("#errorContainer").show();
                        $("#resultsContainer").hide();
                    }
                },
                error: function(xhr, status, error) {
                    // Reset button state
                    searchButton.html(originalButtonText);
                    searchButton.prop('disabled', false);
                    
                    // Display error message
                    var errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred while processing your request.';
                    $("#errorContainer").html('<div class="alert alert-danger">' + errorMessage + '</div>');
                    $("#errorContainer").show();
                    $("#resultsContainer").hide();
                }
            });
        });
        
        // Function to display results in the table
        function displayResults(patients) {
            const tableBody = $("#patientsTableBody");
            tableBody.empty();
            
            if (patients && patients.length > 0) {
                // Show results container
                $("#resultsContainer").show();
                
                // Add patient rows to the table
                patients.forEach(function(patient) {
                    const row = $("<tr>");
                    
                    row.append($("<td>").text(patient.opd_number || 'N/A'));
                    row.append($("<td>").text(patient.fullname || (patient.firstname + ' ' + patient.lastname)));
                    row.append($("<td>").text(patient.gender ? patient.gender.gender : 'N/A'));
                    
                    // Calculate age from birth_date
                    const age = patient.birth_date ? calculateAge(patient.birth_date) : 'N/A';
                    row.append($("<td>").text(age));
                    
                    row.append($("<td>").text(patient.religion ? patient.religion.religion : 'N/A'));
                    row.append($("<td>").text(patient.telephone || 'N/A'));
                    
                    // Get sponsor info
                    let sponsorInfo = 'N/A';
                    if (patient.patientSponsor && patient.patientSponsor.length > 0) {
                        sponsorInfo = patient.patientSponsor[0].sponsor ? patient.patientSponsor[0].sponsor.sponsor_name : 'N/A';
                    }
                    row.append($("<td>").text(sponsorInfo));
                    
                    // Format date
                    const formattedDate = patient.added_date ? formatDate(patient.added_date) : 'N/A';
                    row.append($("<td>").text(formattedDate));
                    
                    tableBody.append(row);
                });
            } else {
                // No results found
                $("#errorContainer").html('<div class="alert alert-info">No patients found matching your criteria.</div>');
                $("#errorContainer").show();
                $("#resultsContainer").hide();
            }
        }
        
        // Helper function to calculate age from birth date
        function calculateAge(birthDate) {
            return moment().diff(moment(birthDate), 'years');
        }
        
        // Helper function to format date
        function formatDate(dateString) {
            return moment(dateString).format('YYYY-MM-DD');
        }
        
        // Reset form and clear results
        $("#resetButton").on('click', function() {
            $("#patientReportForm")[0].reset();
            $("#resultsContainer").hide();
            $("#errorContainer").hide();
        });
        
        // Export buttons functionality
        $("#exportPdfBtn").on('click', function() {
            $("#report_type").val('PDF');
            $("#patientReportForm").submit();
            $("#report_type").val('View');
        });
        
        $("#exportExcelBtn").on('click', function() {
            $("#report_type").val('Excel');
            $("#patientReportForm").submit();
            $("#report_type").val('View');
        });
        
        $("#exportWordBtn").on('click', function() {
            $("#report_type").val('Word');
            $("#patientReportForm").submit();
            $("#report_type").val('View');
        });
        
        $("#printBtn").on('click', function() {
            window.print();
        });
    });
</script>
</x-app-layout>