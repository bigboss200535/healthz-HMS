<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\PatientVisitsController;
use App\Http\Controllers\CodeGenerationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PDFReportController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportsController;
use App\Models\Product;
use App\Models\ServiceRequest;
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
    Route::resource('users', ProfileController::class);
    Route::resource('sponsors', SponsorController::class); 
    Route::resource('services', ServiceRequestController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('products', ProductController::class);
    Route::get('/patient/search', [PatientController::class, 'search'])->name('patient.search');

    Route::prefix('reports')->group(function () {
        Route::get('users/{user_id}', [ReportsController::class, 'users']);
        Route::get('all', [ReportsController::class, 'index']);
        Route::get('patient', [ReportsController::class, 'patient']);
    });
    // Route::get('patient/create/', [PatientController::class, 'create'])->name('patient.create');
    // Route::get('patient/search/', [ PatientController::class, 'index'])->name('patient.index');
    // Route::get('patient/modify/{patient_id}', [PatientController::class, 'edit'])->name('patient.create');
    // Route::get('patient/visits/{patient_id}', [PatientVisitsController::class, 'index'])->name('attendance.index');
    // Route::get('patients/details/{patient_id}', [PatientController::class, 'show'])->name('patient.show');

    Route::get('patient/attendance/{patient_id}', [PatientVisitsController::class, 'show'])->name('attendance.show');
    Route::get('/services/{clinic}/get_specialty', [ServiceRequestController::class, 'getspecialties']);
    Route::get('/services/{service_id}/service_tarif', [ServiceRequestController::class, 'gettarrifs']);
    Route::post('/services/patient_service', [ServiceRequestController::class, 'store']);
    Route::get('/services/patient_service_data/{patient_id}', [ServiceRequestController::class, 'retrieve']);    
});

require __DIR__.'/auth.php';
