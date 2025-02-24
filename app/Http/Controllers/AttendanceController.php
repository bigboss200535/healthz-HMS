<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientAttendance;

class AttendanceController extends Controller
{
    public function single_attendance($patient_id)
    {
        $all_single_attendance = PatientAttendance::where('patient_attendance.archived','No')
                // ->join('patient_sponsorship', 'patient_sponsorship.patient_id', '=', 'patient_attendance.patient_id')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 
                         'patient_attendance.full_age', 'service_attendance_type.attendance_type as pat_clinic', 'patient_attendance.episode_id', 
                         'patient_attendance.patient_id', 
                         'sponsor_type.sponsor_type as sponsor', 'patient_attendance.service_type', 'patient_attendance.service_issued')  
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
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
            ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 
            'patient_attendance.full_age',  'service_attendance_type.attendance_type as pat_clinic' , 'sponsor_type.sponsor_type as sponsor',
            'patient_attendance.service_issued' ,'patient_attendance.attendance_type', 'patient_attendance.patient_id', 'patient_attendance.episode_id')
            ->where('patient_attendance.patient_id', $patient_id)
            ->whereDate('patient_attendance.attendance_date',  $todays_date) 
            ->orderBy('patient_attendance.attendance_id', 'desc')
            ->get();

            return response()->json($todays_request);
    }

    // public function single_attendance(Request $request, $patient_id)
    //  {
    //     $patients = DB::table('patient_info')
    //         ->where('patient_info.patient_id', $patient_id)
    //         ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
    //         ->join('title', 'patient_info.title_id', '=', 'title.title_id')
    //         ->select('patient_info.patient_id', 'title.title', 'patient_info.fullname',  'gender.gender', 
    //             'patient_info.birth_date', 'patient_info.email','patient_info.address',  'patient_info.added_date', 
    //             'patient_info.telephone', DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
    //         ->orderBy('patient_info.added_date', 'asc') 
    //         ->first();

    //  }

    // $service_requests = ServiceRequest::where('patient_attendance.archived','No')
    //         ->join('patient_sponsorship', 'patient_sponsorship.patient_id', '=', 'patient_attendance.patient_id')
    //         ->join('sponsor_type', 'patient_sponsorship.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
    //         ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.clinic_code')
    //         ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 'patient_attendance.pat_age', 
    //                 'service_attendance_type.attendance_type', 'sponsor_type.sponsor_type')
    //         ->where('patient_attendance.patient_id', $patient->patient_id)
    //         ->orderBy('patient_attendance.attendance_id', 'asc')
    //         ->get();

    
}
