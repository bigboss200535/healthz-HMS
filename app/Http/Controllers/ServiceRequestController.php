<?php

namespace App\Http\Controllers;

use App\Models\Age;
use App\Models\Episode;
use App\Models\Patient;
use App\Models\ServiceAttendancetype;
use App\Models\PatientAttendance;
use App\Models\PatientSponsor;
use App\Models\ServicePoints;
use App\Models\ServiceRequest;
use App\Models\AgeGroups;
use App\Models\SponsorType;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Helpers\TimeManagement;


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
        // $fee_column = 0;
        $patient = Patient::where('archived', 'No')
            ->where('patient_id', $request->input('patient_id'))
            ->select('patient_id', 'fullname', 'birth_date', 'telephone', 'gender_id', 'nationality_id', 
                     DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as age'))
            ->first();
        
        $sponsor = PatientSponsor::where('patient_id', $patient->patient_id)
            ->where('archived', 'No')
            ->where('priority', 1)
            ->where('is_active', 'Yes')
            ->first();

            if (!$sponsor) {
                $sponsor = (object) [
                    'sponsor_id' => '100',
                    'sponsor_type_id' => 'P001',
                ];
                $insured = '0';
            }
                     
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
            $result = DB::select('CALL GetAgeGroup(?);', [$patient->age]);

            $age_type = $result[0]->age_description ?? null;

            // Check if a valid age group was found
            if (!$age_type) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid age.'
                ], 400);
            }
       
        $age_code = $age_type === 'ADULT' ? 'adult_code' : 'child_code';
        $fee_column = $age_type === 'ADULT' ? 'nhis_adult' : 'nhis_child'; 
        $code_column = $age_type === 'ADULT' ? 'gdrg_adult' : 'gdrg_child'; 
            
            if ($sponsor->sponsor_type_id == 'P001') 
            {
                $fee_column = $patient->nationality_id == '10001' ? 'cash_amount' : 'foreigners_amount';
                $topup = 0;
            }
            elseif ($sponsor->sponsor_type_id == 'N002') 
            {
                $fee_column = $age_type === 'ADULT' ? 'nhis_adult' : 'nhis_child';
                $cash_amount = 0 ;
                $topup = 0;
            }
            elseif ($sponsor->sponsor_type_id == 'PC04') 
            {
                $fee_column = 'company_amount';
                // $cash_amount = 0 ;
                $topup = 0;
            }
            elseif ($sponsor->sponsor_type_id == 'PI03') 
            {
                $fee_column = 'private_amount';
                // $cash_amount = 0 ;
                $topup = 0;
            } 
            else {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid Sponsor type.'
                ], 400);
            }

            // Fetch fee charges
        $fee_charges = DB::table('services_fee')
                ->where('service_fee_id', $service_code->$age_code)
                ->select($fee_column, $code_column, 'cash_amount', 'topup_amount', 'allow_nhis', 'allow_topup', 
                'editable', 'service_id', 'service_fee_id')
                ->get();

        if ($fee_charges->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Service Fee has not been set up.'
            ], 404);
        }

        // Transform the collection properly
        $transformed_charges = $fee_charges->map(function ($item) use ($fee_column, $code_column) {
            return [
                'nhis_amount' => $item->$fee_column ?? null,
                'gdrg' => $item->$code_column ?? null,
                'cash_amount' => $item->cash_amount ?? null,
                'topup_amount' => $topup ?? null,
                'allow_nhis' => $item->allow_nhis ?? null,
                'allow_topup' => $item->allow_topup ?? null,
                'editable' => $item->editable ?? null,
                'service_id' => $item->service_id ?? null,
                'service_fee_id' => $item->service_fee_id ?? null
            ];
        });

        return response()->json([
            'success' => true,
            'result' => $transformed_charges->toArray() // Convert to array explicitly
        ]);
    }

    
    public function patient_requests($patient_id)
    {
        // if (!Auth::user()->can('view_patient_requests', $patient_id)) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized to view patient requests'
        //     ], 403);
        // }

        $service_requests = PatientAttendance::where('patient_id', $patient_id)
            ->where('archived', 'No')
            ->get();

        return response()->json([
            'success' => true,
            'result' => $service_requests
        ]);
    }

   
}
