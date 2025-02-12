<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PatientAttendance;

class PatientVisitsController extends Controller
{
    public function index(Request $request, $patient_id)
    {
        
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store()
    {
        
        try {
            // Validate the request data
            $validator = Validator::make($request->all(), [
                'pat_id' => 'required',
                'pat_age' => 'required',
                'full_age' => 'required',
                'pat_number' => 'required',
                'clinics' => 'required',
                'service_type' => 'required',
                'credit_amount' => 'nullable|numeric',
                'cash_amount' => 'nullable|numeric',
                'top_up' => 'nullable|numeric',
                'gdrg_code' => 'nullable',
                'attendance_date' => 'required|date',
                'pat_type' => 'required|in:0,1'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Begin transaction
            DB::beginTransaction();

             // Create new service request
             $serviceRequest = PatientAttendance::create([
                'patient_id' => $request->pat_id,
                'patient_age' => $request->p_age,
                'patient_age' => $request->p_age,
                'episode_id' => $request->episode_id,
                'opd_number' => $request->pat_number,
                'service_point_id' => $request->clinics,
                'service_type_id' => $request->service_type,
                'credit_fee' => $request->credit_amount,
                'cash_fee' => $request->cash_amount,
                'gdrg_code' => $request->gdrg_code,
                'attendance_date' => $request->attendance_date,
                'attendance_type' => $request->pat_type,
                'created_by' => auth()->id()
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Service request created successfully',
                'data' => $serviceRequest
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show()
    {

    }

    public function destroy()
    {

    }

}

