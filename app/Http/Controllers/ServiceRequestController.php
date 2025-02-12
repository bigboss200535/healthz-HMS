<?php

namespace App\Http\Controllers;

use App\Models\Age;
use App\Models\EpisodeGenerate;
use App\Models\Patient;
use App\Models\ServiceAttendancetype;
use App\Models\PatientAttendance;
use App\Models\ServicePoints;
use App\Models\ServiceRequest;
use App\Models\SponsorType;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;




class ServiceRequestController extends Controller
{
     public function index()
    {
       
    }

    public function create(Request $request, $clinic_id)
    {
        
    }

    public function store(Request $request)
    {
        // $old_episode = 0;
            try {
                $validated_data = $request->validate([
                    'patient_id' => 'required|max:50',
                    'opd_number' => 'required|max:50',
                    'clinic_code' => 'required|string',
                    'service_type' => 'required|string',
                    'credit_amount' => 'nullable',
                    'cash_amount' => 'nullable',
                    'top_up' => 'nullable',
                    'gdrg_code' => 'nullable|string|max:50',
                    'attendance_date' => 'required|date',
                    'attendance_type' => 'nullable|string|max:50', 
                    //out or in
                ]);
        
        $patient = Patient::where('archived', 'No')
            ->where('patient_id', $request->input('patient_id'))
            ->select('patient_id', 'birth_date', DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as patient_age'))
            ->first();

        if(!$patient) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
            }

       $sponsor = PatientSponsor::where('opd_number', $patient->opd_number)
            ->where('archived', 'No')
            ->where('priority', 1)
            ->where('is_active', 'Yes')
            ->first();

        if(!sponsor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Patient sponsor not found'
            ], 404);
        }

        $age_full = $this->get_age_full($patient->birth_date);
        
        // $episode = DB::table('patient_episode')
        //     ->where('patient_id', $request->input('patient_id'))
        //     ->select('patient_id', 'fullname', 'birth_date', 'telephone', 'gender_id', DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as age'))
        //     ->first();
        
        $old_episode = PatientAttendance::count();
        // $new_episode = $old_episode + 1;
                // Begin transaction
                DB::beginTransaction();
    
                 // Create new service request
                 $service_request = PatientAttendance::create([
                    'patient_id' => $request->patient_id,
                    'opd_number' => $request->opd_number,
                    'pat_age' => $patient->patient_age,
                    'full_age' => $age_full,
                    'clinic_code' => $request->clinic_code,
                    'service_type' => $request->service_type,
                    'credit_fee' => $request->credit_amount,
                    'cash_fee' => $request->cash_amount,
                    'gdrg_code' => $request->gdrg_code,
                    'status_code' => '2', //For out_patient
                    'service_issued' => '0',
                    'attendance_date' => $request->attendance_date,
                    'attendance_time' => now(),
                    'attendance_type' => $request->pat_type,
                    'user_id' => Auth::user()->user_id
                ]);
    
                DB::commit();
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service request created successfully',
                    // 'data' => $service_request
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

    public function show(Request $request, $clinic_id)
    {
       
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
   
    }


    public function getspecialties(Request $request, $clinic_id)
    {
        $clinic_attendance = ServicePoints::select('service_point_id','service_points','attendance_type_id', 'clinic_id')
           ->where('service_point_id', $clinic_id)
           ->first();

        if (!$clinic_attendance) {
            return response()->json([
                'success' => false,
                'message' => 'Clinic not found',
            ], 404);
        }

        $at_clinic = ServiceAttendancetype::where('attendance_type_id', $clinic_attendance->attendance_type_id)
             ->where('archived', 'No')
             ->get();

        return response()->json([
            'success' => true,
            'result' => $at_clinic
        ]);
    }
   

    public function gettarrifs($service_id, Request $request)
    {
        $patients = DB::table('patient_info')
            ->where('patient_id', $request->input('patient_id'))
            ->select('patient_id', 'fullname', 'birth_date', 'telephone', 'gender_id', DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as age'))
            ->first();

        // Fetch service code in one query
        $service_code = DB::table('service_attendance_type')
            ->where('archived', 'No')
            ->where('attendance_type_id', $service_id)
            ->first();

        // Handle case when service is not found or is archived
        if (!$service_code) {
            return response()->json([
                'success' => false,
                'message' => 'Service not found .'
            ], 404);
        }

        // Calculate age group directly from patient's birth date
        $patient_age = $patients->age;

        $result = DB::select('CALL GetAgeGroup(?);', [$patient_age]);
        $age_group = $result[0]->age_description ?? null;

        // Check if a valid age group was found
        if (!$age_group) {
            return response()->json([
                'success' => false,
                'message' => 'No valid age.'
            ], 400);
        }
        // Determine the age code based on the age group
        $age_code = null;

        if ($age_group === 'ADULT') {
            $age_code = 'adult_code';
        } elseif ($age_group === 'CHILD') {
            $age_code = 'child_code';
        }

        // Return error if no valid age group was found
        if (is_null($age_code)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid age group.'
            ], 400);
        }

        $fee_column = $age_group === 'ADULT' ? 'nhis_adult' : 'nhis_child'; 
        $code_column = $age_group === 'ADULT' ? 'gdrg_adult' : 'gdrg_child'; 

        $fee_charges = DB::table('services_fee') ->where('service_fee_id', $service_code->$age_code) 
         ->select($fee_column, 'cash_amount', $code_column, 'topup_amount', 'foreigners_amount', 'company_amount', 'allow_nhis', 'allow_topup', 'editable') ->get(); 
            $fee_charges = $fee_charges->map(function ($item) use ($fee_column, $code_column) { 
            $item->nhis_amount = $item->$fee_column; 
            unset($item->$fee_column); 
            $item->gdrg = $item->$code_column; 
            unset($item->$code_column); 
        return $item; }); 

        // Return error if fee charges are not set up
        if ($fee_charges->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Service Fee has not been set up'
            ], 404);
        }

        // Return the fee charges
        return response()->json([
            'success' => true,
            'result' => $fee_charges
        ]);
    }

    private function episode_id()
    {
        $row_count = ServiceRequest::count();
        $new_number = $row_count + 1;
        return str_pad($new_number, 6, '0', STR_PAD_LEFT);
    }

    public function get_episode_no($patient_id)
    {
        $patient_status = Patient::where('death_status', '=', 'No')
        ->where('patient_id', $patient_id)
        ->first();        
    }

    private function get_age_full($birthdate)
    {
        $dob = Carbon::parse($birthdate); 
        $today = Carbon::now();
        $age_in_days = $dob->diffInDays($today);

            if ($age_in_days == 1) {
                return "1 DAY";
            } elseif ($age_in_days < 7) {
                return "$age_in_days DAYS";
            } elseif ($age_in_days < 14) {
                return "1 WEEK";
            } elseif ($age_in_days < 30) {
                $age_in_weeks = floor($age_in_days / 7);
                return "$age_in_weeks WEEKS";
            } elseif ($age_in_days == 30) {
                return "1 MONTH";
            } elseif ($age_in_days < 365) {
                $age_in_months = floor($age_in_days / 30);
                return "$age_in_months MONTHS";
            } elseif ($age_in_days == 365) {
                return "1 YEAR";
            } else {
                 $age_in_years = floor($age_in_days / 365);
                return "$age_in_years YEARS";
            }
    }

}
