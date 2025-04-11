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
    
    public function getOnHoldPatients()
    {
            $patients = DB::table('patient_attendance')
                ->join('patients', 'patient_attendance.patient_id', '=', 'patients.patient_id')
                ->join('clinics', 'patient_attendance.clinic_id', '=', 'clinics.clinic_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->select(
                    'patient_attendance.*',
                    'patients.fullname',
                    'patients.gender',
                    'patients.full_age',
                    'patients.opd_number',
                    'clinics.clinic_name as pat_clinic',
                    'sponsors.sponsor_name as sponsor'
                )
                ->where('patient_attendance.service_issued', '2')
                ->get();
            
            $patients = $patients->map(function ($patient, $key) {
                $patient->DT_RowIndex = $key + 1;
                return $patient;
            });
            
            return response()->json($patients);
    }

        public function holdAttendance($id)
        {
            try {
                // Update the service_issued field to '2' for on-hold status
                DB::table('patient_attendance')
                    ->where('attendance_id', $id)
                    ->update(['service_issued' => '2']);
                
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
        }

        public function resumeAttendance($id)
        {
            try {
                // Update the service_issued field back to '0' for pending status
                DB::table('patient_attendance')
                    ->where('attendance_id', $id)
                    ->update(['service_issued' => '0']);
                
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
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
                'patient_attendance.patient_id',
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
            // ->where('role_id', 'R10')
            ->get();
        
        $systemic = DB::table('systemic_areas')
            ->where('archived', 'No')
            ->get();  

        return view('consultation.opd_consult', compact( 'attendance', 'doctors', 'con_room', 'systemic'));
    }


    public function ipd_consult()
    {

    }

    public function consult(Request $request)
    {
        $start_date = $request->input('start_date', date('Y-m-d'));
        $end_date = $request->input('end_date', date('Y-m-d'));

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
                ->whereIn('patient_attendance.service_issued', ['0', '1'])
                ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();

            return view('consultation.consult', compact('all')); 
    }
    
    /**
     * Get waiting list patients via AJAX
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWaitingList(Request $request)
    {
        try {
            $start_date = $request->input('start_date', date('Y-m-d'));
            $end_date = $request->input('end_date', date('Y-m-d'));
            
            $patients = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select(
                    'patient_attendance.attendance_id',
                    'patient_info.fullname', 
                    'patient_attendance.opd_number', 
                    'patient_attendance.attendance_date', 
                    'sponsors.sponsor_name',
                    'patient_attendance.full_age', 
                    'gender.gender', 
                    'service_attendance_type.attendance_type as pat_clinic', 
                    'sponsor_type.sponsor_type as sponsor', 
                    'sponsor_type.sponsor_type_id',
                    'patient_attendance.service_issued',
                    'patient_attendance.attendance_type'
                )
                ->where('patient_attendance.archived', 'No')
                ->whereIn('patient_attendance.service_issued', ['0', '1'])
                ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();
            
            // Format the date for display
            $formattedPatients = $patients->map(function($patient) {
                $patient->formatted_date = \Carbon\Carbon::parse($patient->attendance_date)->format('d-m-Y');
                return $patient;
            });
            
            return response()->json([
                'success' => true,
                'data' => $formattedPatients,
                'message' => 'Patients retrieved successfully'
            ]);
            
        } catch (\Exception $e) {
            // \Log::error('Error fetching waiting list: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving patients: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    




}