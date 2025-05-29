<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\PatientVisitsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClaimsPrivateController;
use App\Http\Controllers\ClaimsNhisController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\NursesNotesController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServicesFeeController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PatientReportController;
use App\Http\Controllers\MedicationsController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\NotificationController; 
use App\Http\Controllers\AttendanceController; 
use App\Http\Controllers\ExternalCallController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\InvestigationController;
use Illuminate\Support\Facades\Route;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function (){
//     return view('login');
// });
Route::redirect('/', '/login');
// Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user-profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')
        ->missing(function (Request $request){
          return Redirect::route('dashboard');
    });
   
    // Route::resource('service', ServiceRequestController::class);
    Route::resource('sponsors', SponsorController::class); 
    Route::resource('servicesandfee', ServicesFeeController::class);
    Route::resource('service', ServicesController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('products', ProductController::class);
    Route::resource('diagnosis', DiagnosisController::class);
    Route::resource('clinics', ClinicController::class);
    Route::resource('healthfacilitysetup', FacilityController::class);
    
    Route::prefix('patient')->group(function () {
        Route::get('/attendance', [AttendanceController::class, 'all_attendance'])->name('patient.attendance');
        Route::get('/search', [PatientController::class, 'search'])->name('patient.search');
        Route::get('/patient-sponsors/{patient_id}', [PatientController::class, 'get_patient_sponsor'])->name('patient.get_patient_sponsor');
        Route::get('/patient-request/{patient_id}', [ServiceRequestController::class, 'get_patient_request'])->name('patient.get_patient_sponsor');
        Route::get('/new-opd-number/{service_point_id}', [PatientController::class, 'generate_opd_number'])->name('patient.generate_opd_number');
        Route::get('/single-attendance/{patient_id}', [AttendanceController::class, 'single_attendance'])->name('patient.single_attendance');
        Route::get('/current-attendance/{patient_id}', [AttendanceController::class, 'current_attendance'])->name('patient.current_attendance');
        Route::get('/appointments', [AttendanceController::class, 'appointments'])->name('patient.appointments');
        Route::get('/sponsors', [PatientController::class, 'list_all_patient_sponsors'])->name('patient.list_all_patient_sponsors');
        
        Route::get('/investigations', [InvestigationController::class, 'index'])->name('investigations.index');
        Route::get('/add-labs/{attendance_id}', [InvestigationController::class, 'add_results']);
        Route::get('/add-ultrasound/{attendance_id}', [InvestigationController::class, 'add_results']);
        Route::get('/add-x-rays/{attendance_id}', [InvestigationController::class, 'add_results'])->where('attendance_id', '[0-9]+');
       
    });

    Route::prefix('attendance')->group(function () {
        
        Route::get('/delete-attendance/{attendance_id}', [AttendanceController::class, 'delete_attendance']);
    });

    // Route::prefix('patient')->group(function () {
       
    // });
    
    // Add this route to handle the AJAX request
    Route::resource('users', UserController::class);

    Route::prefix('users')->group(function (){
        Route::get('/manage-permissions/{user_id}', [UserController::class, 'permissions'])->name('users.permissions');
        Route::get('/permissions/{user_id}', [UserController::class, 'permissions'])->name('users.permissions');
    
    // Route::post('/add-users', [UserController::class, 'store'])->name('users.store');
   });


    Route::prefix('services')->group(function () {
        Route::get('/{clinic}/get_specialty', [ServiceRequestController::class, 'getspecialties']);
        Route::get('/{service_id}/service_tarif', [ServiceRequestController::class, 'gettarrifs']);
        Route::post('/patient_service', [ServiceRequestController::class, 'store']);
        Route::get('/patient_service_data/{patient_id}', [ServiceRequestController::class, 'retrieve'])->middleware('auth'); 
        Route::post('/service_request', [ServiceRequestController::class, 'store']);
        Route::post('/add-diagnosis', [DiagnosisController::class, 'add_diagnosis']);
        Route::post('/add-prescription', [PrescriptionController::class, 'add_medicine']);
    });

    Route::prefix('reports')->group(function () {
        // Route::get('/users/{user_id}', [ReportsController::class, 'users']);
        // Route::get('/all', [ReportsController::class, 'index']);
        // Route::get('/patient', [ReportsController::class, 'patient']);
    });

    // Route::get('patient/attendance/{patient_id}', [PatientVisitsController::class, 'show'])->name('attendance.show');
    // Route::get('/services/{clinic}/get_specialty', [ServiceRequestController::class, 'getspecialties']);
    // Route::get('/services/{service_id}/service_tarif', [ServiceRequestController::class, 'gettarrifs']);
    // Route::post('/services/patient_service', [ServiceRequestController::class, 'store']);
    // Route::get('/services/patient_service_data/{patient_id}', [ServiceRequestController::class, 'retrieve']); 
    Route::get('claims/nhis-management', [ClaimsNhisController::class, 'index']);

    Route::prefix('claims')->group(function () {
        Route::resource('/private-management', ClaimsPrivateController::class);
        // Route::get('/company-management', [ClaimsController::class, 'index']);
      
        // Route::get('/cash-management', [ClaimsController::class, 'index']);
    });

    Route::prefix('consultation')->group(function () {
        Route::get('/opd-waiting', [ConsultationController::class, 'getWaitingList']); // New AJAX endpoint
        Route::get('/opd-consultation/{attendance_id}', [ConsultationController::class, 'opd_consult']);
        Route::get('/ipd-consultation/{attendance_id}', [ConsultationController::class, 'ipd_consult']);
        Route::get('/consult', [ConsultationController::class, 'consult']);
        Route::get('/get-systemic-symptoms/{systemic_id}', [ConsultationController::class, 'getSystemicSymptoms']); // New route for fetching symptoms
        // Route::get('patient', [ReportsController::class, 'patient']);
    });

    Route::prefix('nurses')->group(function () {
        Route::get('/general-vitals', [NursesNotesController::class, 'general_vitals']);
        Route::get('/notes', [NursesNotesController::class, 'index']);
        Route::get('/24hour-report', [NursesNotesController::class, 'index']);
        Route::get('/anc-vitals', [NursesNotesController::class, 'index']);
        Route::get('/obgy-vitals', [NursesNotesController::class, 'index']);
        Route::get('/eye-vitals', [NursesNotesController::class, 'index']);
        Route::get('/medications', [NursesNotesController::class, 'index']);
        // Route::get('patient', [ReportsController::class, 'patient']);
    });

    // Route::prefix('consultation')->group(function () {
    //     Route::get('/', [ReportsController::class, 'users']);
    //     Route::get('all', [ReportsController::class, 'index']);
    //     Route::get('patient', [ReportsController::class, 'patient']);
    // });
   
     Route::prefix('notifications')->group(function () {
        Route::get('/sms-list', [NotificationController::class, 'index'])->name('notifications.sms-list');
        Route::post('/send-sms', [NotificationController::class, 'send_sms'])->name('notifications.send-sms');
        Route::get('/sms-setup', [NotificationController::class, 'index']);
        Route::get('/email-setup', [NotificationController::class, 'index']);
        Route::get('/emails', [NotificationController::class, 'index']);
        // Route::get('all', [ReportsController::class, 'index']);
        // Route::get('patient', [ReportsController::class, 'patient']);
        
    });
    // Route::get('/search-prescription', [MedicationsController::class, 'search_prescription']);
    Route::prefix('claims_code')->group(function () {
        Route::post('/save-ccc', [NotificationController::class, 'send_sms'])->name('notifications.save-ccc');
    });

    Route::delete('delete-diagnosis/{diagnosis_id}', [DiagnosisController::class, 'delete_diagnosis']);
    // Route::get('get-diagnosis/{attendance_id}', [DiagnosisController::class, 'get_diagnosis']);
    // Route::get('search-diagnosis', [DiagnosisController::class, 'search_diagnosis']);
    Route::post('add-diagnosis', [DiagnosisController::class, 'add_diagnosis']);
    Route::get('search-prescription', [MedicationsController::class, 'search_prescription']);

    // Route::post('code_generate', [ExternalCallController::class, 'claims_check_code']);

    // Route::prefix('reports')->group(function () {
    //     Route::get('/', function () {
    //         return view('reports.patients.index');
    //     })->name('index');
    //      Route::post('/generate', [App\Http\Controllers\PatientReportController::class, 'generate'])->name('generate');
    // });
});

require __DIR__.'/auth.php';


// Hold and resume attendance routes
// Route::post('/consultation/hold-attendance/{id}', [App\Http\Controllers\ConsultationController::class, 'holdAttendance']);
// Route::post('/consultation/resume-attendance/{id}', [App\Http\Controllers\ConsultationController::class, 'resumeAttendance']);
// Route::get('/consultation/get-on-hold-patients', [App\Http\Controllers\ConsultationController::class, 'getOnHoldPatients']);
// Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('regenerate-session');

    
    // Patient Reports
    Route::prefix('reports')->group(function () {
        Route::get('/patients', [App\Http\Controllers\PatientReportController::class, 'index'])->name('index');
        Route::post('/patients/generate', [App\Http\Controllers\PatientReportController::class, 'generate'])->name('reports.patients.generate');
        Route::get('/patients/results', [App\Http\Controllers\PatientReportController::class, 'results'])->name('reports.patients.results');
        Route::get('/patients/print', [App\Http\Controllers\PatientReportController::class, 'print'])->name('reports.patients.print');
        
        // Export routes
        Route::get('/export/pdf', [App\Http\Controllers\PatientReportController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/excel', [App\Http\Controllers\PatientReportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/word', [App\Http\Controllers\PatientReportController::class, 'exportWord'])->name('export.word');
    });

    
// });

