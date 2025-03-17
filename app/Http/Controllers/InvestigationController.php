<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientAttendance;

class InvestigationController extends Controller
{
    public function index()
    {
        $all = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select('patient_attendance.attendance_id','patient_info.fullname', 'patient_attendance.opd_number', 
                        'patient_attendance.attendance_date', 'sponsors.sponsor_name',
                        'patient_attendance.full_age', 'gender.gender', 'service_attendance_type.attendance_type as pat_clinic', 
                        'sponsor_type.sponsor_type as sponsor', 'sponsor_type.sponsor_type_id',
                        'patient_attendance.service_issued' ,'patient_attendance.attendance_type')
                ->where('patient_attendance.archived', 'No')
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();
            
        return view('investigations.index', compact('all'));
    }
}
