<?php

namespace App\Http\Controllers;

use App\Models\EpisodeGenerate;
use App\Models\Patient;
use App\Models\ServiceAttendancetype;
use App\Models\ServicePoints;
use App\Models\ServiceRequest;
use App\Models\SponsorType;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
        $clinic_id = '000';
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
            'clinics' => 'required|string|max:255',
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

        $service_equest = ServiceRequest::create([
            'patient_id' => $request->p_id,
            'clinic_code' => $request->clinics,
            'service_type' => $request->service_type,
            'credit_amount' => $request->credit_amount ?? 0, 
            'cash_amount' => $request->cash_amount ?? 0,     
            'gdrg_code' => $request->gdrg_code,
            'reg_type' => $request->pat_type,
            'episode_id' => $request->episode_id,
            'pat_age' => $request->p_age,
            'attendance_time' => $request->attendance_date,
            'attendance_date' => $request->attendance_date,
            'user_id' => Auth::check() ? Auth::id() : null,   
        ]);

        return response()->json([
            'success' => true,
            'result' => 'Saved Successfully',
            // 'data' => $service_equest,
        ]);
    
    }

    private function episode_id()
    {
        $row_count = ServiceRequest::count();
        $new_number = $row_count + 1;
        return str_pad($new_number, 6, '0', STR_PAD_LEFT);
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

        // if (!$clinic_attendance) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Clinic not found',
        //     ], 404);
        // }

        $at_clinic = ServiceAttendancetype::where('attendance_type_id', $clinic_attendance->attendance_type_id)
        ->where('archived', 'No')
        ->get();

        return response()->json([
            'success' => true,
            'result' => $at_clinic
        ]);
        
    }

    public function gettarrifs(Request $request, $service)
    {
        $age_group = 'Adult';
        $age_code ='';

         $service_code = DB::table('service_attendance_type')
        ->where('archived', 'No')
        ->where('attendance_type_id', $service)
        ->first();

        if($age_group=='Adult'){
            $age_code = $service_code->adult_code;

            return $age_code;
        }
        else if ($age_group=='Child'){
            $age_code = $service_code->child_code;
            return $age_code;
        }

        $fee_charges = DB::table('services_fee')
        ->where('archived', 'No')
        ->where('service_fee_id', $age_code)
        ->select('services.')
        ->get();

        return response()->json([
            'success' => true,
            'result' => $fee_charges
        ]);
    }

    private function fetch()
    {

    }

    public function retrieve(Request $request, $patient_id)
    {
        $data = ServiceRequest::where('patient_id', $patient_id)->first();

        return response()->json([
            'success' => true,
            'result' => $data
        ]);
    }

}
