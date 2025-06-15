<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicationsController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\ExternalCallController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\PrescriptionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('search-diagnosis', [DiagnosisController::class, 'search_diagnosis']);

Route::get('get-diagnosis/{attendance_id}', [DiagnosisController::class, 'get_diagnosis']);
Route::get('search-diagnosis', [DiagnosisController::class, 'search_diagnosis']);
Route::get('/getsponsortype', [App\Http\Controllers\SponsorController::class, 'get_sponsors_by_type'])->name('get.sponsors.by.type');
Route::post('claims_code', [ExternalCallController::class, 'validateMemberAndGenerateCCC']);  
Route::post('/medication/search', [PrescriptionController::class, 'search_medications']);
// Route::get('edit-diagnosis/{diagnosis_id}', [DiagnosisController::class, 'edit_diagnosis']);


// Route::post('save-prescription', [MedicationsController::class, 'save_prescription']);
// Route::get('get-prescription', [MedicationsController::class, 'get_prescription']);
// Route::get('delete-prescription', [MedicationsController::class, 'delete_prescription']);
// Route::get('edit-prescription', [MedicationsController::class, 'edit_prescription']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
