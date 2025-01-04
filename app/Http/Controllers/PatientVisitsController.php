<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientVisitsController extends Controller
{
    public function index(Request $request, $patient_id)
    {
        $patients = DB::table('patient_info')
            ->where('patient_info.patient_id', $patient_id)
            ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
            ->join('title', 'patient_info.title_id', '=', 'title.title_id')
            ->join('users', 'patient_info.user_id', '=', 'users.user_id')
            ->select('patient_info.patient_id', 'title.title', 'patient_info.fullname', 'gender.gender', 
                    'patient_info.birth_date', 'patient_info.email', 'patient_info.address', 'patient_info.contact_person', 
                    'patient_info.contact_relationship', 'patient_info.contact_telephone', 'patient_info.added_date', 
                    'patient_info.telephone', 'users.user_fullname', DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
            ->orderBy('patient_info.added_date', 'asc') 
            ->first();

        return view('attendance.index' , compact('patients'));
    }

    public function show(Request $request, $patient_id)
    {
        $patients = DB::table('patient_info')
        ->where('patient_info.patient_id', $patient_id)
        ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
        // ->join('title', 'patient_info.title, '=', 'title.title_id')
        ->join('users', 'patient_info.user_id', '=', 'users.user_id')
        ->select('patient_info.patient_id', 'patient_info.fullname', 'gender.gender', 
        'patient_info.birth_date', 'patient_info.email', 'patient_info.address', 'patient_info.contact_person', 
        'patient_info.contact_relationship', 'patient_info.contact_telephone', 'patient_info.added_date', 
        'patient_info.telephone', 'users.user_fullname',
        DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
        ->orderBy('patient_info.added_date', 'asc') 
        ->first();

        return view('attendance.show' , compact('patients'));
    }


}

