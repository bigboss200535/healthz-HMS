<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PatientSponsor;
use App\Models\PatientOpdNumber;
use App\Models\Patient;
use App\Models\Age;
use App\Models\AgeGroups;
use App\Models\PatientAttendance;
use App\Helpers\TimeManagement;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\ServicePoints;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
         $query = PatientAttendance::where('patient_attendance.archived','No')
                    ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                    ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                    ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                    ->join('users', 'users.user_id', '=', 'patient_attendance.user_id')
                    ->join('consultation_issue_status', 'consultation_issue_status.issue_id', '=', 'patient_attendance.issue_id')
                    ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                    ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
                    ->select('patient_attendance.attendance_id','patient_info.fullname', 'patient_attendance.opd_number', 
                            'patient_attendance.attendance_date', 'sponsors.sponsor_name', 'sponsor_type.sponsor_type', 
                            'sponsor_type.sponsor_type_id', 'patient_attendance.full_age', 'gender.gender', 
                            'service_attendance_type.attendance_type as type_of_attendance', 
                            'patient_attendance.issue_id' ,'patient_attendance.attendance_type', 
                            'consultation_issue_status.issue_value', 'consultation_issue_status.color_code', 
                            'users.user_fullname')
                    ->where('patient_attendance.archived', 'No');

         // Apply search filter if provided
         if ($request->has('search') && !empty($request->search)) {
             $search = $request->search;
             $query->where(function($q) use ($search) {
                 $q->where('patient_info.fullname', 'LIKE', '%' . $search . '%')
                   ->orWhere('patient_attendance.opd_number', 'LIKE', '%' . $search . '%');
             });
         }

         // Apply date range filter if provided
         if ($request->has('start_date') && !empty($request->start_date)) {
             $query->whereDate('patient_attendance.attendance_date', '>=', $request->start_date);
         }

         if ($request->has('end_date') && !empty($request->end_date)) {
             $query->whereDate('patient_attendance.attendance_date', '<=', $request->end_date);
         }

         // Get the filtered results
         $all_attendance = $query->orderBy('patient_attendance.attendance_id', 'desc')->get();

         return view('attendance.index', compact('all_attendance')); 
    }


    public function generate_episode(Request $request)
    {
         $today_date = TimeManagement::today_date();

         $episode = Episode::where('patient_id', $request->patient_id)
             ->where('added_date', $today_date)
             ->get();
         
             if(!$episode)
             {
                 Episode::create([
                     'patient_id' => $request->patient_id,
                     'pat_number' => $request->pat_number,
                     'request_date' => $request->pat_number,
                     'start_date' => $validated_data['sponsor_id'],
                      'end_date' => $validated_data['sponsor_id'],
                     'code' => $validated_data['member_no'],
                     'facility_id' => Auth::user()->facility_id,
                     'user_id' => Auth::user()->user_id,
                     'added_date' => $now,
                 ]);
             }
    }

    public function single_attendance($patient_id)
    {
        $all_single_attendance = PatientAttendance::where('patient_attendance.archived','No')
                // ->join('patient_sponsorship', 'patient_sponsorship.patient_id', '=', 'patient_attendance.patient_id')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 
                         'patient_attendance.full_age', 'service_attendance_type.attendance_type as pat_clinic', 'patient_attendance.episode_id', 
                         'patient_attendance.patient_id',
                         'sponsor_type.sponsor_type as sponsor', 'patient_attendance.service_type', 'patient_attendance.issue_idd')  
                ->where('patient_attendance.patient_id', $patient_id)
                ->orderBy('patient_attendance.attendance_id', 'asc')
                ->get();

        return response()->json($all_single_attendance);
    }

    public function current_attendance($patient_id)
    {
        $todays_date = date('Y-m-d');

        $todays_request = PatientAttendance::where('patient_attendance.archived','No')
            ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
            ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 
                     'patient_attendance.full_age',  'service_attendance_type.attendance_type as pat_clinic' , 
                     'sponsor_type.sponsor_type as sponsor',
                     'patient_attendance.issue_id', 
                     'patient_attendance.attendance_type'
                     )
            ->where('patient_attendance.patient_id', $patient_id)
            // ->whereDate('patient_attendance.attendance_date',  $todays_date) 
            ->orderBy('patient_attendance.attendance_id', 'desc')
            ->get();

            return response()->json($todays_request);
    }

    public function all_attendance()
    {
        $all = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->join('users', 'users.user_id', '=', 'patient_attendance.user_id')
                ->join('consultation_issue_status', 'consultation_issue_status.issue_id', '=', 'patient_attendance.issue_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
                ->select('patient_attendance.attendance_id','patient_info.fullname', 'patient_attendance.opd_number', 
                        'patient_attendance.attendance_date', 'sponsors.sponsor_name', 'sponsor_type.sponsor_type', 
                        'sponsor_type.sponsor_type_id', 'patient_attendance.full_age', 'gender.gender', 
                        'service_attendance_type.attendance_type as type_of_attendance', 
                        'patient_attendance.issue_id' ,'patient_attendance.attendance_type', 
                        'consultation_issue_status.issue_value', 'consultation_issue_status.color_code', 'users.user_fullname')
                ->where('patient_attendance.archived', 'No')
                // ->where('patient_attendance.archived', 'No')
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();

            return view('patient.attendance', compact('all')); 
    }

     
    public function delete_attendance(Request $request, $attendance_id)
    {
            // Find the attendance record
            $attendance = PatientAttendance::where('archived', 'No')
                ->where('attendance_id', $attendance_id)
                ->first();

            if (!$attendance) {
                return response()->json([
                    'message' => 'Attendance not found.',
                    'code' => 404,
                ], 404); // Return 404 for "Not Found"
            }

            // Check if service has been issued
            if ($attendance->issue_id == 1) {
                return response()->json([
                    'message' => 'Service has been issued. Attendance cannot be deleted.',
                    'code' => 403,
                ], 403); // Return 403 for "Forbidden"
            }

            // Update only the necessary fields
            $attendance->archived = 'Yes';
            $attendance->archived_by = Auth::user()->user_id;
            $attendance->archived_date = now();

            // Save the changes
            try {
                if ($attendance->save()) {
                    return response()->json([
                        'message' => 'Attendance Deleted Successfully.',
                        'code' => 201,
                    ], 201); // Return 201 for "OK"
                } else {
                    return response()->json([
                        'message' => 'Failed to Delete Attendance.',
                        'code' => 200,
                    ], 200); // Return 500 for "Internal Server Error"
                }
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'An error occurred while deleting the attendance.',
                    'code' => 200,
                ], 200); // Return 500 for "Internal Server Error"
            }
    }


    public function create_attendance(Request $request)
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
                    'issue_id' => '2',
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


    private function get_default_sponsor()
    {
        return (object) [
            'sponsor_id' => '100',
            'sponsor_type_id' => 'P001',
        ];
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

    // public function attendance_clinic(Request $request, $opd_number)
    // {
    //      $decoded_opd_number = urldecode($opd_number);
    //     //   \Log::info('Fetching clinics for OPD:', ['opd_number' =>$decoded_opd_number]);
    //         try {

    //             $patients = PatientOpdNumber::where('patient_nos.opd_number',$decoded_opd_number)
    //                 ->join('patient_info', 'patient_info.patient_id', '=', 'patient_nos.patient_id')
    //                 ->where('patient_nos.patient_id', $patient_id)
    //                 ->select(
    //                     'patient_info.patient_id', 
    //                     'patient_nos.opd_number', 
    //                     'patient_info.birth_date', 
    //                     'patient_info.address', 
    //                     'patient_info.gender_id', 
    //                     DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as patient_age')
    //                 )->firstOrFail();

    //             $ages = Age::where('min_age', '<=', $patients->patient_age)
    //                 ->where('max_age', '>=', $patients->patient_age)
    //                 ->where('usage', '0')
    //                 ->first();

    //             if (!$ages) {
    //                 return response()->json(['error' => 'No age group found'], 404);
    //             }

    //             $clinic_attendance = ServicePoints::select('service_point_id', 'service_points', 'gender_id', 'age_id')
    //                 ->where(function ($query) use ($patients) {
    //                     $query->where('gender_id', $patients->gender_id)
    //                         ->orWhere('gender_id', 1); // All gender
    //                 })
    //                 ->where(function ($query) use ($ages) {
    //                     $query->where('age_id', $ages->age_id)
    //                         ->orWhere('age_id', 3); // All age group
    //                 })
    //                 ->where('archived', 'No')
    //                 ->where('is_active', 'Yes')
    //                 ->get();

    //             return response()->json($clinic_attendance);

    //         } catch (\Exception $e) {
    //             return response()->json(['error' => 'Patient not found'], 404);
    //         }
    //     }
    public function attendance_clinic(Request $request, $opd_number)
    {
        $decoded_opd_number = urldecode($opd_number);
        $patient_id = $request->get('patient_id'); 

        \Log::info('Fetching clinics for OPD:', ['opd_number' => $decoded_opd_number, 'patient_id' => $patient_id]);
        
        try {
            if (!$patient_id) {
                return response()->json(['error' => 'Patient ID is required'], 400);
            }

            $patients = PatientOpdNumber::where('patient_nos.opd_number', $decoded_opd_number)
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_nos.patient_id')
                ->where('patient_nos.patient_id', $patient_id)
                ->select(
                    'patient_info.patient_id', 
                    'patient_nos.opd_number', 
                    'patient_info.birth_date', 
                    'patient_info.address', 
                    'patient_info.gender_id', 
                    DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as patient_age')
                )->firstOrFail();

            $ages = Age::where('min_age', '<=', $patients->patient_age)
                ->where('max_age', '>=', $patients->patient_age)
                ->where('usage', '0')
                ->first();

            if (!$ages) {
                return response()->json(['error' => 'No age group found'], 404);
            }

            $clinic_attendance = ServicePoints::select('service_point_id', 'service_points', 'gender_id', 'age_id')
                ->where(function ($query) use ($patients) {
                    $query->where('gender_id', $patients->gender_id)
                        ->orWhere('gender_id', 1); // All gender
                })
                ->where(function ($query) use ($ages) {
                    $query->where('age_id', $ages->age_id)
                        ->orWhere('age_id', 3); // All age group
                })
                ->where('archived', 'No')
                ->where('is_active', 'Yes')
                ->get();

            return response()->json($clinic_attendance);

        } catch (\Exception $e) {
            \Log::error('Error fetching attendance clinics: ' . $e->getMessage());
            return response()->json(['error' => 'Patient not found'], 404);
        }
    }


           
}
