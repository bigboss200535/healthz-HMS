<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

class ServicesController extends Controller
{
    public function index()
    {
        $services_fees = Services::where('services_fee.archived', 'No')
            ->where('services_fee.status', '=','Active')
            ->rightjoin('services', 'services.service_id', '=', 'services_fee.service_id')
            ->orderBy('services.service_name', 'asc')
            ->get();

        // $total_all = Product::where('archived', '=', 'No')->count();
        // $total_drugs = Product::where('product_type_id', '=', '1')->count();
        // $total_consumable = Product::where('product_type_id', '=', '2')->count();
        // $total_others = Product::where('product_type_id', '=', '3')->count();

        // $item = Services::rightJoin('product_type', 'product_type.product_type_id', '=', 'products.product_type_id')
        // ->rightjoin('stores', 'stores.store_id', '=', 'products.store_id')
        // ->where('products.archived', 'No')
        // ->select('products.*','product_type.*', 'stores.*')
        // ->orderBy('products.product_name', 'asc')
        // // ->lockForUpdate() 
        // ->get();

        return view('services.index', compact('services_fees'));
    }
}
