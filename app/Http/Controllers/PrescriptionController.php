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

    public function search_products(Request $request)
    {

        $opd_number = $request->input('opd_number');
        $patient_id = $request->input('patient_id');
        $query = $request->input('prescription_query');

        $start = '&'. $query;
        $contain = '&' . $query . '&';
        $end = $query . '&';

        $attendance = DB::table('patient_attendance')
            ->where('archived', 'No')
            ->where('opd_number', $opd_number)
            ->orderBy('attendance_id', 'desc')
            ->first();

        // if (!$attendance) {
        //         return response()->json([]);
        //     }

       // Fetch prescriptions
       $prescriptions = ProductStock::where('product_stocked.archived', 'No')
            ->where('product_stocked.status', 'Active')
            ->join('products', 'product_stocked.product_id', 'products.product_id')
            ->where(function ($query) use ($attendance) {
                $query->where('products.age_id', $attendance->age_id)
                    ->orWhere('products.age_id', '3');
            })
            ->where(function ($query) use ($attendance) {
                $query->where('products.gender_id', $attendance->gender_id)
                    ->orWhere('products.gender_id', '1');
            })

            ->where('diagnosis', 'like', '%' . $diagnosis_query . '%')
             ->select('products.product_id', 'products.product_name', 'product_stocked.store_id', 'product_stocked.stock_level', 
                    'product_stocked.expiry_date', 'products.age_id', 'products.gender_id')
            ->orderBy('products.product_name', 'asc')
            ->limit(50)
            ->get();

             return response()->json($diagnosis);

    }
}
