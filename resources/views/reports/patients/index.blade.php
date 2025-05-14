<x-app-layout> 
<div class="container-xxl flex-grow-1 container-p-y">   
    <div class="card">
        <div class="card-header">
            <h4>Patient Reports</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('reports.patients.generate') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="gender_id">Gender</label>
                            <select name="gender_id" id="gender_id" class="form-control">
                                <option value="">All Genders</option>
                                @foreach($genders as $gender)
                                    <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="religion_id">Religion</label>
                            <select name="religion_id" id="religion_id" class="form-control">
                                <option value="">All Religions</option>
                                @foreach($religions as $religion)
                                    <option value="{{ $religion->religion_id }}">{{ $religion->religion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sponsor_id">Sponsor</label>
                            <select name="sponsor_id" id="sponsor_id" class="form-control">
                                <option value="">All Sponsors</option>
                                @foreach($sponsors as $sponsor)
                                    <option value="{{ $sponsor->sponsor_id }}">{{ $sponsor->sponsor_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="sponsor_type_id">Sponsor Type</label>
                            <select name="sponsor_type_id" id="sponsor_type_id" class="form-control">
                                <option value="">All Sponsor Types</option>
                                @foreach($sponsorTypes as $type)
                                    <option value="{{ $type->sponsor_type_id }}">{{ $type->sponsor_type }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date_from">Date From</label>
                            <input type="date" name="date_from" id="date_from" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="date_to">Date To</label>
                            <input type="date" name="date_to" id="date_to" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <label>Report Format</label>
                    <div class="d-flex gap-2">
                        <button type="submit" name="action" value="view" class="btn btn-primary">
                            <i class="fas fa-eye"></i> View Report
                        </button>
                        <button type="submit" name="action" value="pdf" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </button>
                        <button type="submit" name="action" value="excel" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Download Excel
                        </button>
                        <button type="submit" name="action" value="word" class="btn btn-info">
                            <i class="fas fa-file-word"></i> Download Word
                        </button>
                        <button type="submit" name="action" value="print" class="btn btn-secondary">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>