<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;
use App\Models\Product;
use App\Models\ProductStock;

class PrescriptionController extends Controller
{
    public function add_medicine(Request $request)
    {
        $attendance = DB::table('patient_attendance')
            ->where('archived', 'No')
            ->where('opd_number', $request->opd_number)
            ->orderBy('attendance_id', 'desc')
            ->first();

        if (!$attendance) {
                return response()->json([]);
            }

       // Fetch drugs
        $medicine = Product::where('archived', 'No')
            ->where('status', 'Active')
            ->where(function ($query) use ($attendance) {
                $query->where('age_id', $attendance->age_id)
                    ->orWhere('age_id', '3');
            })
            ->where(function ($query) use ($attendance) {
                $query->where('gender_id', $attendance->gender_id)
                    ->orWhere('gender_id', '1');
            })
            ->where('product_type_id', '1')
            ->where('product_name', 'like', '%' . $request->product_name . '%')
            ->select('product_id', 'product_name', 'prescription_qty', 'store_id', 
                    'nhis_id', 'is_stockable', 'nhis_cover', 'gender_id', 
                    'presentation', 'base_unit')
            ->orderBy('product_name', 'asc')
            ->limit(10)
            ->get();

        return response()->json($medicine);
    }
// public function search_diagnosis(Request $request)
// {
//     $diagnosis_query = $request->input('diagnosis_query');
    
//     $diagnoses = DB::table('diagnosis')
//         ->where('archived', 'No')
//         ->where('status', 'Active')
//         ->where(function($query) use ($diagnosis_query) {
//             $query->where('diagnosis_name', 'like', '%' . $diagnosis_query . '%')
//                   ->orWhere('diagnosis_code', 'like', '%' . $diagnosis_query . '%');
//         })
//         ->select('diagnosis_id', 'diagnosis_name', 'diagnosis_code')
//         ->orderBy('diagnosis_name', 'asc')
//         ->limit(50)
//         ->get();
        
//     return response()->json($diagnoses);
// }

    public function search_medications(Request $request)
    {
        $opd_number = $request->input('opd_number');
        $patient_id = $request->input('patient_id');
        $prescription_query = $request->input('prescription_query');

        $start = '&'. $prescription_query;
        $contain = '&' . $prescription_query . '&';
        $end = $prescription_query . '&';

        $attendance = DB::table('patient_attendance')
            ->where('archived', 'No')
            ->where('opd_number', $opd_number)
            ->orderBy('attendance_id', 'desc')
            ->first();
            
         // Fetch prescriptions
        $prescriptions = ProductStock::where('product_stocked.archived', 'No')
            ->where('product_stocked.status', 'Active')
            ->join('products', 'product_stocked.product_id', 'products.product_id')
            ->join('product_prices', 'product_prices.product_id', 'product_stocked.product_id')
            ->where(function ($query) use ($attendance) {
                $query->where('products.age_id', $attendance->age_id)
                    ->orWhere('products.age_id', '3');
            })
            ->where(function ($query) use ($attendance) {
                $query->where('products.gender_id', $attendance->gender_id)
                    ->orWhere('products.gender_id', '1');
            })

            ->where('products.product_name', 'like', '%' . $prescription_query . '%')
            ->select('products.product_id', 'products.product_name', 'product_stocked.store_id', 'product_stocked.stock_level', 
                    'product_stocked.expiry_date', 'products.pres_quanity_per_issue_unit','products.age_id', 'products.gender_id', 'product_prices.unit_cost', 
                    'product_prices.cash_price', 'product_prices.cooperate_price', 'product_prices.private_insurance_price', 
                    'product_prices.nhis_amount', 'product_prices.nhis_topup')
            ->orderBy('products.product_name', 'asc')
            ->limit(50)
            ->get();

            return response()->json($prescriptions);
    }
}
