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
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\NotificationController; 
use App\Http\Controllers\ExternalCallController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')
        ->missing(function (Request $request){
          return Redirect::route('dashboard');
    });
   
    Route::resource('service', ServiceRequestController::class);
    Route::resource('users', UserController::class);
    Route::resource('sponsors', SponsorController::class); 
    Route::resource('servicesandfee', ServicesFeeController::class);
    Route::resource('service', ServicesController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('products', ProductController::class);
    Route::resource('diagnosis', DiagnosisController::class);
    Route::resource('clinics', ClinicController::class);
    Route::resource('healthfacilitysetup', FacilityController::class);
    
    Route::prefix('patient')->group(function () {
        Route::get('/search', [PatientController::class, 'search'])->name('patient.search');
        Route::get('/patient-sponsors/{patient_id}', [PatientController::class, 'get_patient_sponsor'])->name('patient.get_patient_sponsor');
        Route::get('/new-opd-number/{service_point_id}', [PatientController::class, 'generate_opd_number'])->name('patient.generate_opd_number');
    });
    
    Route::prefix('request')->group(function () {
        Route::post('/service_request', [ServiceRequestController::class, 'store']);
    });

    Route::prefix('reports')->group(function () {
        // Route::get('/users/{user_id}', [ReportsController::class, 'users']);
        // Route::get('/all', [ReportsController::class, 'index']);
        // Route::get('/patient', [ReportsController::class, 'patient']);
    });

    // Route::get('patient/attendance/{patient_id}', [PatientVisitsController::class, 'show'])->name('attendance.show');
    Route::get('/services/{clinic}/get_specialty', [ServiceRequestController::class, 'getspecialties']);
    Route::get('/services/{service_id}/service_tarif', [ServiceRequestController::class, 'gettarrifs']);
    Route::post('/services/patient_service', [ServiceRequestController::class, 'store']);
    Route::get('/services/patient_service_data/{patient_id}', [ServiceRequestController::class, 'retrieve']); 
    
    Route::prefix('claims')->group(function () {
        Route::resource('/private-management', ClaimsPrivateController::class);
        // Route::get('/company-management', [ClaimsController::class, 'index']);
        Route::resource('/nhis-management', ClaimsNhisController::class);
        // Route::get('/cash-management', [ClaimsController::class, 'index']);
    });

    Route::prefix('consultation')->group(function () {
        Route::get('/opd-consultation/{patient_id}', [ConsultationController::class, 'opd_consult']);
        Route::get('/ipd-consultation', [ConsultationController::class, 'ipd-consult']);
        Route::get('/consult', [ConsultationController::class, 'consult']);
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
        Route::get('/all', [NotificationController::class, 'index']);
        // Route::get('all', [ReportsController::class, 'index']);
        // Route::get('patient', [ReportsController::class, 'patient']);
        
    });

    Route::post('code_generate', [ExternalCallController::class, 'claims_check_code']);
});

require __DIR__.'/auth.php';
