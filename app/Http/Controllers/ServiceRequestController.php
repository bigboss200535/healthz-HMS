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
       try {
              $validated_data = $request->validate([
                    'patient_id' => 'required|max:50',
                    'opd_number' => 'required|max:50',
                    'service_point_id' => 'required|string',
                    'attendance_type_id' => 'required|string',
                    'credit_amount' => 'nullable',
                    'cash_amount' => 'nullable',
                    'service_id' => 'nullable|string',
                    'service_fee_id' => 'nullable|string',
                    'top_up' => 'nullable',
                    'gdrg_code' => 'nullable|string|max:50',
                    'attendance_date' => 'required|date',
                    'attendance_type' => 'nullable|string|max:50', 
                ]);
            
            // Authorization check
            // if (!Auth::user()->can('create_service_request')) {
            //     return response()->json([
            //         'status' => 'error',
            //         'message' => 'Unauthorized to create service requests'
            //     ], 403);
            // }

            $patient_detail = $this->patient_by_id($validated_data['patient_id']);

                if (!$patient_detail) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Patient not found'
                    ], 404);
                }
            $sponsor = PatientSponsor::where('opd_number', $validated_data['opd_number'])
                    ->where('archived', 'No')
                    ->where('priority', 1)
                    ->where('is_active', 'Yes')
                    ->select('sponsor_id', 'sponsor_type_id')
                    ->first();

            // Validate sponsor fallback logic
            $default_sponsor = $this->get_default_sponsor();
            $sponsor_type_id = $sponsor->sponsor_type_id ?? $default_sponsor->sponsor_type_id;
            $sponsor_id = $sponsor->sponsor_id ?? $default_sponsor->sponsor_id;
            $insured = $sponsor ? '1' : '0';

            $ages = $this->get_age_id($patient_detail->birth_date);
            $age_group = AgeGroups::get_category_from_age($patient_detail->patient_age);
            $today = TimeManagement::today_date();

        DB::beginTransaction();

                 $service_request = PatientAttendance::create([
                    'attendance_id' => $this->get_attendance_id(),
                    'patient_id' => $validated_data['patient_id'],
                    'opd_number' => $validated_data['opd_number'],
                    'pat_age' => $patient_detail->patient_age,
                    'full_age' => $this->get_age_full($patient_detail->birth_date),
                    'service_id' => $validated_data['service_id'] ?? 0, 
                    'service_fee_id' => $validated_data['service_fee_id'] ?? 0, 
                    'service_point_id' => $validated_data['service_point_id'],
                    'attendance_type_id' => $validated_data['attendance_type_id'],
                    'age_id' => $ages->age_id,
                    'gender_id' => $patient_detail->gender_id,
                    'age_group_id' => $age_group->age_group_id,
                    'request_type' => 'INWARD',
                    'episode_id' => '0',
                    'attendance_no' => date('Ymdhis'),
                    'sponsor_type_id' => $sponsor_type_id,
                    'sponsor_id' => $sponsor_id,
                    'credit_amount' => $validated_data['credit_amount'],
                    'cash_amount' => $validated_data['cash_amount'],
                    'gdrg_code' => $validated_data['gdrg_code'],
                    'status_code' => $status_code ?? '2',
                    'insured' => $insured,
                    'issue_id' => '0',
                    'records_no' => $this->get_records_no(),
                    'attendance_date' => $validated_data['attendance_date'],
                    'attendance_type' => $validated_data['attendance_type'],
                    'attendance_time' => now(),
                    'added_date' => $today,
                    'facility_id' => Auth::user()->facility_id ?? '',
                    'added_by' => Auth::user()->user_fullname ?? '',
                    'user_id' => Auth::user()->user_id,
                    'added_id' => Auth::user()->user_id,
                ]);
    
                DB::commit();
    
                return response()->json([
                    'status' => 'success',
                    'message' => 'Service request created successfully',
                ], 201);
    
            } catch (\Exception $e) {
                DB::rollBack();
                
                        Log::error('Service request creation failed: ' . $e->getMessage(), [
                        'user_id' => Auth::id(),
                        'patient_id' => $request->input('patient_id')
                    ]);

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

    private function get_default_sponsor()
    {
        return (object) [
            'sponsor_id' => '100',
            'sponsor_type_id' => 'P001',
        ];
    }

    private function episode_id()
    {
        $row_count = PatientAttendance::count();
        $new_number = $row_count + 1;
        return str_pad($new_number, 6, '0', STR_PAD_LEFT);

        $old_episode_id = Episode::get()->count();
        $new_episode_id = $old_episode_id + 1;
    }

    private function get_episode_no(Request $request, $patient_id)
    {
        $check_episode = Episode::where('patient_id', $validated_data['patient_id'])
           ->where('added_date', TimeManagement::today_date())
           ->get();

        $episode = 0;  
        $episode = Episode::get()->count();
        $new_episode_id = $episode + 1;

           if(!$check_episode )
           {
                $data = Episode::create([
                    'episode_id' => $new_episode_id,
                    'patient_id' => $patient_id,
                    'pat_number' => $opd_number,
                    'episode_clinic' => $service_point_id,
                    'code' => $new_episode_id,
                    'user_id' => Auth::user()->user_id,
                    'added_date' => now(),
                    'request_date' => now(),
                   ]);
           }else{
                return response()->json([
                    'episode_id' => '0',
                    'patient_id' => $patient_id
                    ],);
        
           }  
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

    private function get_age_id($birthdate)
    {   
        $age = Carbon::parse($birthdate)->age;
        
        $ages = Age::where('min_age', '<=', $age)
            ->where('max_age', '>=', $age)
            ->where('max_age', '>=', $age)
            ->where('category', '1')
            ->select('age_id')
            ->first();

        return $ages;
    }

    private function get_attendance_id()
    {
          $old_episode_id = PatientAttendance::get()->count();
          $new_id = $old_episode_id + 1;
          $attendance_id = str_pad($new_id, 7, '0', STR_PAD_LEFT);
          return 'A' .$attendance_id;
    }

    private function get_records_no()
    {
          $old_episode_id = PatientAttendance::get()->count();
          $new_id = $old_episode_id + 1;
          return $new_id;
    }

    private function patient_by_id($patient_id)
    {
         $patient = Patient::where('archived', 'No')
            ->where('patient_id', $patient_id)
            ->select('birth_date', 'patient_id', 'gender_id' ,DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as patient_age'))
            ->first();

        if(!$patient) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
         }else if($patient){
            return $patient;
        }
    }

   
}
