<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Gender;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Prescriptions;
use App\Models\PatientAttendance;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\DB;

class PrescriptionController extends Controller
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

    public function show()
    {

    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'prescription_patient_id' => 'nullable|min:3',
            'prescription_opdnumber' => 'nullable|min:3',
            'prescription_product_id' => 'nullable|min:3',
            'prescription_attendance_id' => 'string|min:1',
            // 'consulting_date' => 'nullable|min:3|max:50',
            // 'age_id' => 'nullable|min:1',
            'episode_id' => 'nullable|min:3',
            'prescription_price' => 'nullable|min:1',
            'prescription_presentation_input' => 'nullable',
            'prescription_type' => 'nullable|min:3|max:50',
            'prescription_dosage' => 'nullable',
            'prescription_sponsor' => 'nullable',
            'prescription_frequency' => 'nullable',
            'prescription_duration' => 'nullable',
            'prescription_qty' => 'nullable|min:1|max:50',
            'prescription_start_date' => 'nullable',
            'prescription_end_date' => 'nullable|min:3|max:50',
            'prescription_gdrg' => 'string|min:3|max:50',
            'consulting_doctors' => 'string|min:3',
            // 'prescription_price' => 'nullable',
            'prescription_base_unit' => 'nullable|min:1'
        ]); 

        // $existing_product = Prescription::where('product_name', $request->input('product_name')) ->first();
        // if ($existing_product)
        // {
        //     return 200;
        //  }
         $attendance = PatientAttendance::where('attendance_id', $request->input('prescription_attendance_id'))
              ->where('archived', 'No')
              ->first();

        $prescription_id = $this->prescription_id($request);   

        try {
             DB::beginTransaction();

             $new_prescription = Prescriptions::create([
                    'prescriptions_id' => $prescription_id,
                    'attendance_id' => $validated_data['prescription_attendance_id'],
                    'patient_id' => $validated_data['prescription_patient_id'],
                    'opd_number' => $validated_data['prescription_opdnumber'],
                    'attendance_date' => now(),
                    'product_id' => $validated_data['prescription_product_id'],
                    'attendance_time' => now(),
                    'entry_date' => now(),
                    'age_group_id' => $attendance->age_group_id,
                    'age_id' => $attendance->age_id,
                    'episode_id' => '' ?? $validated_data['episode_id'],
                    'unit_price' => $validated_data['prescription_price'],
                    'presentation' => $validated_data['prescription_presentation_input'],
                    'prescription_type' => $validated_data['prescription_type'],
                    'dosage' => $validated_data['prescription_dosage'],
                    'sponsor_id' => $validated_data['prescription_sponsor'],
                    // 'sponsor_type_id' => $validated_data['prescription_sponsor'],
                    'frequencies' => $validated_data['prescription_frequency'],
                    'duration' => $validated_data['prescription_duration'],
                    'quantity_given' => $validated_data['prescription_qty'],
                    'start_date' => $validated_data['prescription_start_date'],
                    'end_date' => $validated_data['prescription_end_date'],
                    // 'prescription_base_unit' => $prescription_base_unit[''],
                     // 'store_id' => $validated_data[''],
                    'unit_measure' => $validated_data['prescription_base_unit'],
                    // 'quantity_serve' => $validated_data[''],
                    // 'gdrg_code' => $validated_data[''],
                    'added_date' => now(),
                    // 'doctor_id' => $validated_data[''],
                    'added_id' => Auth::user()->user_id,
                    'user_id' => Auth::user()->user_id,
                    'facility_id' => Auth::user()->facility_id ?? '',
                ]);
                 
                DB::commit();

            return response()->json([
                    'message' => 'Prescription save successfully',
                    'code' =>'201'
                ], 201);

           
        } catch (\Throwable $e) {
             
             DB::rollBack();
             return response()->json([
                    'message' => 'Error saving Prescription',
                    'error' => $e->getMessage()
                ], 500);
        }

    }

    public function get_patient_prescriptions(Request $request, $attendance_id)
    {   
        $prescriptions = Prescriptions::where('patient_prescription.archived', 'No')
            ->where('patient_prescription.attendance_id',$attendance_id)
            ->join('products', 'products.product_id', '=', 'patient_prescription.product_id')
            ->join('users', 'users.user_id', '=', 'patient_prescription.user_id')
            // ->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_prescription.sponsor_id')
            ->select('patient_prescription.prescriptions_id',
                    //  'patient_prescription.attendance_id', 
                     'products.product_name', 
                    //  'patient_prescription.diagnosis', 
                     'patient_prescription.attendance_id', 
                     'patient_prescription.patient_id', 
                     'patient_prescription.opd_number', 
                     'patient_prescription.added_date',
                     'patient_prescription.dosage',
                     'patient_prescription.unit_measure',
                     'patient_prescription.frequencies',
                     'patient_prescription.duration',
                     'patient_prescription.quantity_given',
                     'patient_prescription.gdrg_code',
                     'patient_prescription.entry_date',
                    //  'patient_prescription.sponsor_type_id',
                    //  'patient_prescription.quantity_given',
                      'patient_prescription.prescription_type',
                     'patient_prescription.added_id',
                    //  'sponsors.sponsor_name',
                      \DB::raw('UPPER(users.user_fullname) as doctor')
                   )
                    
            ->get();
            
        return response()->json($prescriptions);
    }


   public function delete_prescription(Request $request, $prescriptions_id)
    {
        $prescription = Prescriptions::where('prescriptions_id', $prescriptions_id)->lockForUpdate();
        
        if($prescription->exists()){
            $prescription->update([
                'updated_by' => Auth::user()->user_id,
                'archived_id' => Auth::user()->user_id,
                'archived_date' => now(),
                'archived' => 'Yes'
            ]);
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }


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
                    'product_prices.nhis_amount', 'product_prices.nhis_topup', 'products.presentation', 'products.base_unit'
                    )
            ->orderBy('products.product_name', 'asc')
            ->limit(50)
            ->get();

            return response()->json($prescriptions);
    }

    
     private function prescription_id(Request $request)
    {
        $count_prescription = Prescriptions::count();
        $count_plus_one = $count_prescription + 1;
        $desired_length = 4;
        $alphabet = 'P';
        $formatted_id = str_pad($count_plus_one, $desired_length, '0', STR_PAD_LEFT);
        $prescription_id = $alphabet.$formatted_id;

        return $prescription_id;
    }

    public function add_medicine(Request $request)
    {
        $attendance = DB::table('patient_attendance')
            ->where('archived', 'No')
            ->where('opd_number', $request->opd_number)
            ->orderBy('attendance_id', 'desc')
            ->first();

            if(!$attendance) 
            {
                return response()->json([]);
            }

       // search medications
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

}
