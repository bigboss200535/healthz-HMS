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
use App\Http\Controllers\AppointmentController;
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

Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('sponsors', SponsorController::class); 
    Route::resource('servicesandfee', ServicesFeeController::class);
    Route::resource('service', ServicesController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('products', ProductController::class);
    Route::resource('diagnosis', DiagnosisController::class);
    Route::resource('clinics', ClinicController::class);
    Route::resource('healthfacilitysetup', FacilityController::class);
    Route::resource('users', UserController::class);
     // Route::resource('service', ServiceRequestController::class);

    Route::prefix('reports')->group(function () {
        Route::get('/patients', [App\Http\Controllers\PatientReportController::class, 'index'])->name('index');
        Route::post('/patients/generate', [App\Http\Controllers\PatientReportController::class, 'generate'])->name('reports.patients.generate');
        Route::get('/patients/results', [App\Http\Controllers\PatientReportController::class, 'results'])->name('reports.patients.results');
        Route::get('/patients/print', [App\Http\Controllers\PatientReportController::class, 'print'])->name('reports.patients.print');
        Route::post('/generate', [App\Http\Controllers\PatientReportController::class, 'generate'])->name('generate');
        // Export routes
        Route::get('/export/pdf', [App\Http\Controllers\PatientReportController::class, 'exportPdf'])->name('export.pdf');
        Route::get('/export/excel', [App\Http\Controllers\PatientReportController::class, 'exportExcel'])->name('export.excel');
        Route::get('/export/word', [App\Http\Controllers\PatientReportController::class, 'exportWord'])->name('export.word');
    });

    Route::prefix('patient')->group(function () {
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/fetch', [PatientController::class, 'search_patients'])->name('patient.fetch');
        Route::get('/search', [PatientController::class, 'index'])->name('patient.index');
        Route::get('/patient-sponsors/{patient_id}', [PatientController::class, 'get_patient_sponsor'])->name('patient.get_patient_sponsor');
        Route::get('/patient-request/{patient_id}', [ServiceRequestController::class, 'get_patient_request'])->name('patient.get_patient_sponsor');
        Route::get('/new-opd-number/{service_point_id}', [PatientController::class, 'generate_opd_number'])->name('patient.generate_opd_number');
        Route::get('/single-attendance/{patient_id}', [AttendanceController::class, 'single_attendance'])->name('patient.single_attendance');
        Route::get('/current-attendance/{patient_id}', [AttendanceController::class, 'current_attendance'])->name('patient.current_attendance');
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
        Route::get('/sponsors', [PatientController::class, 'list_all_patient_sponsors'])->name('patient.list_all_patient_sponsors');
        
        Route::get('/investigations', [InvestigationController::class, 'index'])->name('investigations.index');
        Route::get('/add-labs/{attendance_id}', [InvestigationController::class, 'add_results']);
        Route::get('/add-ultrasound/{attendance_id}', [InvestigationController::class, 'add_results']);
        Route::get('/add-x-rays/{attendance_id}', [InvestigationController::class, 'add_results'])->where('attendance_id', '[0-9]+');
        Route::get('/recent-patients', [PatientController::class, 'recent_patient_registration'])->name('patients.recent');
    });

    Route::prefix('consultation')->group(function () {
        Route::get('/opd-waiting', [ConsultationController::class, 'getWaitingList'])->name('patient.waiting.list'); // AJAX endpoint for waiting list
        Route::get('/pending-diagnostics', [ConsultationController::class, 'getPendingDiagnostics'])->name('patient.pending.diagnostics'); // AJAX endpoint for pending diagnostics
        Route::get('/on-hold-patients', [ConsultationController::class, 'get_on_hold_patients'])->name('patient.on.hold'); // AJAX endpoint for on-hold patients
        Route::get('/opd-consultation/{attendance_id}', [ConsultationController::class, 'opd_consult']);
        Route::get('/ipd-consultation/{attendance_id}', [ConsultationController::class, 'ipd_consult']);
        Route::post('/save', [ConsultationController::class, 'store'])->name('consultation.store');
        Route::get('/list', [ConsultationController::class, 'index']);
        Route::get('/get-systemic-symptoms/{systemic_id}', [ConsultationController::class, 'getSystemicSymptoms']); // Route for fetching symptoms
        // Hold and Unhold routes
    Route::post('/hold-attendance/{attendance_id}', [ConsultationController::class, 'hold_attendance']);
    Route::post('/unhold-attendance/{attendance_id}', [ConsultationController::class, 'unhold_attendance']);
        // Route::get('patient', [ReportsController::class, 'patient']);
    });

    Route::prefix('attendance')->group(function () {
        Route::get('/delete-attendance/{attendance_id}', [AttendanceController::class, 'delete_attendance']);
    });


    Route::prefix('users')->group(function () {
        Route::get('/manage-permissions/{user_id}', [UserController::class, 'permissions'])->name('users.permissions');
        Route::get('/permissions/{user_id}', [UserController::class, 'permissions'])->name('users.permissions');
    
    // Route::post('/add-users', [UserController::class, 'store'])->name('users.store');
   });

   Route::prefix('notifications')->group(function () {
        Route::get('/sms-list', [NotificationController::class, 'index'])->name('notifications.sms-list');
        Route::post('/send-sms', [NotificationController::class, 'send_sms'])->name('notifications.send-sms')
         ->middleware('throttle:3,1'); //3 requests per 1 minute
        Route::get('/sms-setup', [NotificationController::class, 'index']);
        Route::get('/email-setup', [NotificationController::class, 'index']);
        Route::get('/emails', [NotificationController::class, 'index']);
        // Route::get('all', [ReportsController::class, 'index']);
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

    Route::prefix('prescriptions')->group(function (){
        // Route::post('/search', [PrescriptionController::class, 'search_medications']);
        Route::post('/save', [PrescriptionController::class, 'store']);
        Route::post('/search', [PrescriptionController::class, 'add_medicine']);
        Route::get('/get-prescriptions/{attendance_id}', [PrescriptionController::class, 'get_patient_prescriptions']);
        Route::get('/delete/{prescriptions_id}', [PrescriptionController::class, 'delete_prescription']);
    });

   Route::prefix('reports')->group(function () {
        // Route::get('/users/{user_id}', [ReportsController::class, 'users']);
        // Route::get('/all', [ReportsController::class, 'index']);
        // Route::get('/patient', [ReportsController::class, 'patient']);
    });

    Route::prefix('claims_code')->group(function () {
        Route::post('/save-ccc', [NotificationController::class, 'send_sms'])->name('notifications.save-ccc');
    });
    
    // Route::get('patient/attendance/{patient_id}', [PatientVisitsController::class, 'show'])->name('attendance.show');
    // Route::get('/services/{clinic}/get_specialty', [ServiceRequestController::class, 'getspecialties']);
    // Route::get('/services/{service_id}/service_tarif', [ServiceRequestController::class, 'gettarrifs']);
    // Route::post('/services/patient_service', [ServiceRequestController::class, 'store']);
    // Route::get('/services/patient_service_data/{patient_id}', [ServiceRequestController::class, 'retrieve']); 

    // Route::prefix('consultation')->group(function () {
    //     Route::get('/', [ReportsController::class, 'users']);
    //     Route::get('all', [ReportsController::class, 'index']);
    //     Route::get('patient', [ReportsController::class, 'patient']);
    // });
   // Hold and resume attendance routes
    Route::post('/consultation/hold-attendance/{id}', [ConsultationController::class, 'holdAttendance']);
    Route::post('/consultation/resume-attendance/{id}', [ConsultationController::class, 'resumeAttendance']);
    Route::delete('/consultation/delete-attendance/{id}', [ConsultationController::class, 'deleteAttendance']);
    // Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('regenerate-session');

    // Route::prefix('reports')->group(function () {
    //     Route::get('/', function () {
    //         return view('reports.patients.index');
    //     })->name('index');
    //      
    // });

    Route::get('claims/nhis-management', [ClaimsNhisController::class, 'index']);

    Route::prefix('claims')->group(function () {
        Route::resource('/private-management', ClaimsPrivateController::class);
        // Route::get('/company-management', [ClaimsController::class, 'index']);
        // Route::get('/cash-management', [ClaimsController::class, 'index']);
    });

    // Route::get('get-diagnosis/{attendance_id}', [DiagnosisController::class, 'get_diagnosis']);
    // Route::get('search-diagnosis', [DiagnosisController::class, 'search_diagnosis']);
    Route::post('add-diagnosis', [DiagnosisController::class, 'add_diagnosis']);
    // Route::get('search-prescription', [MedicationsController::class, 'search_prescription']);

    Route::prefix('diagnosis')->group(function () {
       Route::get('/delete-diagnosis/{diagnosis_id}', [DiagnosisController::class, 'delete_diagnosis']);
    });


    Route::prefix('services')->group(function () {
        Route::get('/{clinic}/get_specialty', [ServiceRequestController::class, 'getspecialties']);
        Route::get('/{service_id}/service_tarif', [ServiceRequestController::class, 'gettarrifs']);
        Route::post('/patient_service', [ServiceRequestController::class, 'store']);
        Route::get('/patient_service_data/{patient_id}', [ServiceRequestController::class, 'retrieve'])->middleware('auth'); 
        Route::post('/service_request', [ServiceRequestController::class, 'store']);
        Route::post('/add-diagnosis', [DiagnosisController::class, 'add_diagnosis']);
    });

    // Route::post('code_generate', [ExternalCallController::class, 'claims_check_code']);
    Route::get('/profile/user-profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::get('/profile/password-change', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')
        ->missing(function (Request $request){
          return Redirect::route('dashboard');
    });
   

});

require __DIR__.'/auth.php';


