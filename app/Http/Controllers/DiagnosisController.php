<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\PatientDiagnosis;
use App\Models\Age;
use App\Models\Gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnosis = Diagnosis::where('archived', 'No')->where('status', '=','Active')
            ->orderBy('diagnosis.diagnosis', 'asc') 
            ->get();
        // ->paginate(20);
         // // ->lockForUpdate() 

        $age = Age::where('archived', 'No')
            ->where('status', 'Active')
            // ->orderBy('age_description', 'asc')
            ->get();

        $gender = Gender::where('archived', 'No')
            ->where('status', 'Active')
            ->get();

        return view('diagnosis.index', compact('diagnosis', 'age' , 'gender'));
    
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

    public function search_diagnosis(Request $request)
    {
        $opd_number = $request->input('opd_number');
        $patient_id = $request->input('patient_id');
        $diagnosis_query = $request->input('diagnosis_query');

        $start = '&'. $diagnosis_query;
        $contain = '&' . $diagnosis_query . '&';
        $end = $diagnosis_query . '&';

        $attendance = DB::table('patient_attendance')
            ->where('archived', 'No')
            ->where('opd_number', $opd_number)
            ->orderBy('attendance_id', 'desc')
            ->first();

        if (!$attendance) {
                return response()->json([]);
            }

       // Fetch diagnoses
        $diagnosis = Diagnosis::where('archived', 'No')
            ->where('status', 'Active')
            ->where(function ($query) use ($attendance) {
                $query->where('age_id', $attendance->age_id)
                    ->orWhere('age_id', '3');
            })
            ->where(function ($query) use ($attendance) {
                $query->where('gender_id', $attendance->gender_id)
                    ->orWhere('gender_id', '1');
            })
            ->where('diagnosis', 'like', '%' . $diagnosis_query . '%')
            ->select('diagnosis_id','diagnosis', 'diagnosis_code', 'icd_10', 'gdrg_code', 'age_id', 
                    'gender_id', 'adult_tarif', 'child_tarif', 'gdrg_adult', 'gdrg_child')
            ->orderBy('diagnosis', 'asc')
            ->limit(50)
            ->get();

        return response()->json($diagnosis);
    }


    public function add_diagnosis(Request $request)
    {   
        $count = 0;
        $count = PatientDiagnosis::count();

        $diagnosis = new PatientDiagnosis();
        $diagnosis->attendance_diagnosis_id = $count + 1;
        $diagnosis->opd_number = $request->input('opd_number');
        $diagnosis->patient_id = $request->input('patient_id');
        $diagnosis->attendance_id = $request->input('attendance_id');
        $diagnosis->diagnosis_id = $request->input('diagnosis_id');
        $diagnosis->diagnosis_type = $request->input('diagnosis_type');
        $diagnosis->diagnosis_category = $request->input('diagnosis_category');
        $diagnosis->gdrg_code = $request->input('diag_gdrg');
        $diagnosis->is_principal = $request->input('diagnosis_principal');
        $diagnosis->diagnosis_fee = $request->input('diag_fee');
        $diagnosis->attendance_date = now();
        $diagnosis->entry_date = now();
        $diagnosis->icd_10 = $request->input('icd_10');
        $diagnosis->doctor_id = $request->input('doctor_id');
        $diagnosis->user_id = Auth::user()->user_id;
       
        $diagnosis->save();

        return response()->json(['success' => true]);
    }

    public function get_diagnosis(Request $request, $attendance_id)
    {   

        $diagnoses = PatientDiagnosis::where('patient_diagnosis.archived', 'No')
            ->where('patient_diagnosis.attendance_id',$attendance_id)
            ->join('diagnosis', 'diagnosis.diagnosis_id', '=', 'patient_diagnosis.diagnosis_id')
            ->join('users', 'users.user_id', '=', 'patient_diagnosis.user_id')
            ->select('patient_diagnosis.attendance_diagnosis_id as diagnosis_table_id',
                     'diagnosis.diagnosis_code', 
                     'diagnosis.diagnosis', 
                     'patient_diagnosis.attendance_id', 
                     'patient_diagnosis.patient_id', 
                    'patient_diagnosis.diagnosis_category', 
                    'patient_diagnosis.entry_date', 
                    'patient_diagnosis.gdrg_code', 
                    'patient_diagnosis.icd_10', 
                    'patient_diagnosis.is_principal',
                    // 'users.user_fullname as doctor_name',
                    \DB::raw('UPPER(users.user_fullname) as doctor_name')
                    )
            ->get();
            
        return response()->json($diagnoses);
    }

    public function get_previous_diagnosis(Request $request, $patient_id)
    {   

        $diagnoses = PatientDiagnosis::where('patient_diagnosis.archived', 'No')
            ->where('patient_diagnosis.patient_id',$patient_id)
            ->join('diagnosis', 'diagnosis.diagnosis_id', '=', 'patient_diagnosis.diagnosis_id')
            ->join('users', 'users.user_id', '=', 'patient_diagnosis.user_id')
            ->select('patient_diagnosis.attendance_diagnosis_id as diagnosis_table_id',
                     'diagnosis.diagnosis_code', 
                     'diagnosis.diagnosis', 
                     'patient_diagnosis.attendance_id', 
                     'patient_diagnosis.patient_id', 
                    'patient_diagnosis.diagnosis_category', 
                    'patient_diagnosis.entry_date', 
                    'patient_diagnosis.gdrg_code', 
                    'patient_diagnosis.icd_10', 
                    'patient_diagnosis.is_principal',
                    // 'users.user_fullname as doctor_name',
                    \DB::raw('UPPER(users.user_fullname) as doctor_name')
                    )
            ->get();
            
        return response()->json($diagnoses);
    }

    public function delete_diagnosis(Request $request, $diagnosis_id)
    {
        $diagnosis = PatientDiagnosis::where('attendance_diagnosis_id', $diagnosis_id)->lockForUpdate();
        
        if($diagnosis->exists()){
            $diagnosis->update([
                'updated_by' => Auth::user()->user_id,
                'archived_by' => Auth::user()->user_id,
                'archived_date' => now(),
                'archived' => 'Yes'
            ]);
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }
}
