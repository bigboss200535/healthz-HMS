<?php

namespace App\Http\Controllers;

use App\Models\ConsultingRoom;
use App\Models\Patient;
use App\Models\PatientAttendance;
use App\Models\Stores;
use App\Models\User;
use App\Models\Diagnosis;
use App\Models\Product;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    
    public function index()
    {
      $pat_req = PatientAttendance::where('patient_attendance.archived', 'No')
          ->rightJoin('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
          ->RightJoin('gender', 'patient_info.gender_id', 'gender.gender_id')       
          ->orderBy('patient_attendance.attendance_id', 'asc')
          ->select('patient_attendance.*', 'patient_info.*', 'gender.gender',  
            DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as pat_ages'))
          ->get();  

          return view('consultation.index', compact('pat_req'));  
    }

    public function create()
    {

    }

    public function edit()
    {

    }

    public function store()
    {

    }

    public function show()
    {

    }

    public function destroy()
    {

    }
    
    public function opd_consult($attendance_id)
    {
        // Base query for attendance
        $attendance_query = PatientAttendance::where('patient_attendance.archived', 'No')
            ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
            ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
            ->join('ages', 'ages.age_id', '=', 'patient_attendance.age_id')
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
            ->select(
                'patient_attendance.attendance_id',
                'patient_attendance.opd_number',
                'patient_attendance.attendance_date',
                'patient_attendance.full_age',
                'patient_info.fullname',
                'ages.age_id',
                'gender.gender',
                'gender.gender_id',
                'service_attendance_type.attendance_type as pat_clinic'
                )
            ->where('patient_attendance.attendance_id', $attendance_id);
               
            // Fetch the sponsor check in a single query
        $sponsor_check = PatientAttendance::where('archived', 'No')
            ->where('attendance_id', $attendance_id)
            ->first();

            if(!$sponsor_check) {
                // return response()->json('Attendance details not found.');
            }

        // Conditionally join sponsor-related tables
        if ($sponsor_check->sponsor_type_id == 'P001') 
        {
                $attendance_query->addSelect(
                    \DB::raw("'CASH PAYMENT' as sponsor_type"),
                    \DB::raw("'CASH' as sponsor")
                );

        }
         else if (in_array($sponsor_check->sponsor_type_id, ['PC04', 'N002', 'PI03'])) 
        {
            $attendance_query->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_attendance.sponsor_id')
                             ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                             ->addSelect('sponsor_type.sponsor_type as sponsor_type', 'sponsors.sponsor_name as sponsor');
        }
    
        $attendance = $attendance_query->first();
    
        if (!$attendance) {
            // return response()->json('Attendance details not found.vvv');
            //  return  'Attendance details not found.';
        }
    
        // Fetch consulting rooms
        $con_room = ConsultingRoom::where('Archived', 'No')
            ->where('status', 'Active')
            ->get();
    
        // Fetch doctors
        $doctors = User::where('status', 'Active')
            ->where('archived', 'No')
            ->where('role_id', 'R10')
            ->get();
    
        return view('consultation.opd_consult', compact( 'attendance', 'doctors', 'con_room'));
    }


    public function ipd_consult()
    {

    }

    public function consult()
    {
        $consult_list = PatientAttendance::where('patient_attendance.archived','No')
            ->join('patient_sponsorship', 'patient_sponsorship.patient_id', '=', 'patient_attendance.patient_id')
            ->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_sponsorship.sponsor_id')
            ->join('sponsor_type', 'patient_sponsorship.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
            ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
            ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.clinic_code')
            // ->join('sponsor_type', 'gender.gender_id', '=', 'patient_info.gender_id')
            // ->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_attendance.sponsor_id')
            // ->join('patient_sponsorship', 'patient_sponsorship.sponsor_id', '=', 'sponsors.sponsor_id')
            ->get();

       return view('consultation.consult', compact('consult_list'));
    }
    
}
