<?php

namespace App\Http\Controllers;

use App\Models\Age;
use App\Models\EpisodeGenerate;
use App\Models\Patient;
use App\Models\ServiceAttendancetype;
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
        // // $service_resuest = ;
        //  // $service_request = Relation::with('users')->get();
        // $sponsors = SponsorType::where('archived', 'No')->where('status', '=','Active')->get();
        // return view('service.index', compact('sponsors'));
    }

    public function create(Request $request, $clinic_id)
    {
        // $clinic_id = '000';
        $service = ServicePoints::select('service_point_id','service_points','gender_id', 'age_id')
        // ->where('gender_id', $patients->gender_id)
        // ->where('age_id', $ages->age_id)
          ->where('archived', 'No')
          ->where('is_active', 'Yes')
          ->get();
    }

    public function store(Request $request)
    {
            $request->validate([
                'p_id' => 'required|string|max:255',
                'opd_id' => 'nullable|string|max:255',
                'pat_age' => 'nullable|string|max:255',
                'pat_age_full' => 'nullable|string|max:255',
                'clinics' => 'required|string|max:255',
                'gender_id' => 'nullable|string|max:255',
                'service' => 'nullable|string|max:255',
                'attendance_type' => 'nullable|string|max:255',
                'attendance_date' => 'required|date',
                'service_type' => 'required|string|max:255',
                'credit_amount' => 'nullable|numeric|min:0',
                'cash_amount' => 'nullable|numeric|min:0',
                'gdrg_code' => 'nullable|string|max:255',
                'pat_type' => 'required|string|max:255',
                'user_id' => 'nullable|string|max:255',
                'episode_id' => 'nullable|string|max:255',
                'p_age' => 'nullable|string|max:255',
                'attendance_date' => 'required|date',
            ]);

            DB::select('CALL GetEpisodeId(?, ?, ?, ?)', [$request->p_id, 'PAT123456', 'CLAIMCODE123', $request->attendance_date]);
                  $patient = Patient::find($request->p_id);
                  $age_in_full = $this->get_age_full($patient->birth_date);

            $service_equest = ServiceRequest::create([
                'patient_id' => $request->p_id,
                'opd_id' => $request->p_id,
                'clinic_code' => $request->clinics,
                'service_type' => $request->service_type,
                'credit_amount' => $request->credit_amount ?? 0, 
                'amount_payable' => $request->credit_amount ?? 0, 
                'topup_code' => $request->credit_amount ?? 0, //Yes or no topup bill
                'cash_amount' => $request->cash_amount ?? 0,   //amount payable if topup or no topup  
                'gdrg_code' => $request->gdrg_code,
                'reg_type' => $request->pat_type,
                'episode_id' => $request->episode_id,
                'pat_age' => $request->p_age,
                'attendance_time' => $request->attendance_date,
                'age_in_full' => $age_in_full,
                'attendance_date' => $request->attendance_date,
                'user_id' => Auth::check() ? Auth::id() : null,   
            ]);

            return response()->json([
                'success' => true,
                'result' => 'Saved Successfully',
                // 'data' => $service_equest,
            ]);
    
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
            ->where('patient_id', $request->input('pat_id'))
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

}
