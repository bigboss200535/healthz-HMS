<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MedicationsController extends Controller
{
    public function index()
    {

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

    public function search_prescription(Request $request)
    {
            $start_date = $request->input('start_date', date('Y-m-d'));
            $end_date = $request->input('end_date', date('Y-m-d'));
            
            $prescription = Product::where('products.archived','No')
                // ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                // ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                // ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                // ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select(
                    'products.product_name',
                    'products.product_id', 
                    'products.age_id', 
                    'products.gender_id', 
                    'products.attendance_date', 
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
            
    }
}
