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
          ->select('patient_attendance.*', 'patient_info.*', 'gender.gender',  DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as pat_ages'))
          ->get();  

      // $patients = DB::table('patient_info')
      //     ->where('patient_info.patient_id', $patient_id)
      //     ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
      //     ->join('title', 'patient_info.title_id', '=', 'title.title_id')
      //     ->select('patient_info.patient_id', 'title.title', 'patient_info.fullname',  'gender.gender', 
      //         'patient_info.birth_date', 'patient_info.email','patient_info.address',  'patient_info.added_date', 
      //         'patient_info.telephone', DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
      //     ->orderBy('patient_info.added_date', 'asc') 
      //     ->first();

          // $con_room = ConsultingRoom::where('Archived', 'No')->get();
          // $store = Stores::where('archived', 'No')->where('is_pharmacy', '=', 'Yes')->get();
          // $outcome = 
          // $patient = 
          // $patient_list = Patient::where('Archived', 'No')->get();
          // if (Auth::user()->role_id==='R10'|| Auth::user()->role_id==='R11')
          // {
          //   $user = User::where(Auth::user()->user_id)->get(); //log in doctor
          // }
          // else
          // {
          //   $user = User::where(Auth::user()->role_id)->get();// all doctors
          // }

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
    
    public function opd_consult(Patient $patient_id)
    {
      $patients = DB::table('patient_info')
          ->where('patient_info.archived', 'No')
          ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
          ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id')
          ->join('users', 'patient_info.user_id', '=', 'users.user_id')
          ->select('patient_info.patient_id', 'patient_nos.opd_number', 'patient_info.title', 'patient_info.fullname', 'gender.gender', 
               'patient_info.birth_date', 'patient_info.email', 'patient_info.address', 'patient_info.contact_person', 
               'patient_info.contact_relationship', 'patient_info.contact_telephone', 'patient_info.added_date', 
               'patient_info.telephone', 'users.user_fullname', 'patient_info.gender_id', DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
          ->orderBy('patient_info.added_date', 'asc') 
          ->get();

          $con_room = ConsultingRoom::where('Archived', 'No')->where('status', 'Active')->get();
          $patient_list = Patient::where('Archived', 'No')->where('status', 'Active')->get();
          $diagnosis = Diagnosis::where('Archived', 'No')->where('status', 'Active')->get();
          $prescription = Product::where('Archived', 'No')->where('status', 'Active')->get();

       return view('consultation.opd_consult', compact('con_room', 'patient_list', 'diagnosis', 'prescription')); 
    }


    public function ipd_consult()
    {

    }

    public function consult()
    {
        $consult_list = ServiceRequest::where('patient_attendance.archived','No')
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


        // $patients = DB::table('patient_info')
        // ->where('patient_info.archived', 'No')
        // ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
        // ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id')
        // // ->join('users', 'patient_info.user_id', '=', 'users.user_id')
        // ->select('patient_info.patient_id', 'patient_nos.opd_number', 'patient_info.title', 'patient_info.fullname', 'gender.gender', 
        //      'patient_info.birth_date', 'patient_info.email', 'patient_info.address', 'patient_info.contact_person', 
        //      'patient_info.contact_relationship', 'patient_info.contact_telephone', 'patient_info.added_date', 
        //      'patient_info.telephone', 'patient_info.gender_id', DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
        // ->orderBy('patient_info.added_date', 'asc') 
        // ->get();

       return view('consultation.consult', compact('consult_list'));
    }
    
}
