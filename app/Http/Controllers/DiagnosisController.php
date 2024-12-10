<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    public function index()
    {
        $diagnosis = Diagnosis::where('archived', 'No')->where('status', '=','Active')
        ->orderBy('diagnosis.diagnosis', 'asc') 
        ->get();

        // $item = Product::rightJoin('product_type', 'product_type.product_type_id', '=', 'products.product_type_id')
        // ->rightjoin('stores', 'stores.store_id', '=', 'products.store_id')
        // ->where('products.archived', 'No')
        // ->select('products.*','product_type.*', 'stores.*')
        // ->orderBy('products.added_date', 'asc')
        // // ->lockForUpdate() 
        // ->get();

        return view('diagnosis.index', compact('diagnosis'));
    
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
}
