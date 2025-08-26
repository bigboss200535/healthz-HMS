<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientAppointments;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = PatientAppointments::where('patient_appointment.archived','No')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_appointment.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->select(
                    // 'patient_appointment.attendance_id',
                    'patient_info.fullname', 'patient_appointment.opd_number', 
                        'patient_appointment.appointment_date',
                        // 'sponsor_type.sponsor_type', 'sponsor_type.sponsor_type_id',
                        // 'patient_appointment.full_age', 
                        'gender.gender')
                ->orderBy('patient_appointment.appointment_id', 'desc')
                ->get();

            return view('appointments.index', compact('appointments')); 
    }
    
    public function create()
    {
        $clinic = Clinic::where('archived', 'No')->get();

        // doctors only (add role id for doctors)
        $doctor = User::where('archived', 'No')->get();

        $patient = Patient::where('archived', 'No')->get();

        // pre-select patient if provided
        $selected_patient = null;

        if($request->filled('patient_id')){
            $selected_patient = Patient::find($request->input('patient_id'));
        }

        return view('appointments.create', compact('clinic', 'doctor', 'patient', 'selected_patient'));

    }
}
