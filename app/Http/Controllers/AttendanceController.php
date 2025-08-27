<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PatientAttendance;
// use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\TimeManagement;

class AttendanceController extends Controller
{
    public function index()
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

            return view('attendance.index', compact('all')); 
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
            if ($attendance->issue_idd == 1) {
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
    
}
