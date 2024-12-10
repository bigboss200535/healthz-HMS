<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProductController extends Controller
{
    public function index()
    {
        $product = Product::where('archived', 'No')->where('status', '=','Active')->get();

        $total_all = Product::where('archived', '=', 'No')->count();
        $total_drugs = Product::where('product_type_id', '=', '1')->count();
        $total_consumable = Product::where('product_type_id', '=', '2')->count();
        $total_others = Product::where('product_type_id', '=', '3')->count();

        $item = Product::rightJoin('product_type', 'product_type.product_type_id', '=', 'products.product_type_id')
        ->rightjoin('stores', 'stores.store_id', '=', 'products.store_id')
        ->where('products.archived', 'No')
        ->select('products.*','product_type.*', 'stores.*')
        ->orderBy('products.product_name', 'asc')
        // ->lockForUpdate() 
        ->get();

        return view('product.index', compact('item', 'total_drugs', 'total_consumable', 'total_others', 'total_all'));
    }

    public function create()
    {
        // $category = Category::where('archived', 'No')->where('status', '=','Active')->get();

        $products = Product::rightJoin('product_category', 'product_category.category_id', '=', 'product.category_id')
        ->where('product.archived', 'No')
        ->where('product.is_new', '1')
        ->select('product.product_id','product.product_name','product.added_date','product.status' ,'product.stocked','product.expirable','product_category.category_id as pro_id', 'product_category.category_name as category')
        ->orderBy('product.added_date', 'asc') 
        ->paginate(5);

        $product = Product::rightJoin('product_category', 'product_category.category_id', '=', 'product.category_id')
        ->where('product.archived', 'No')
        // ->where('product.is_new', '1')
        ->select('product.product_id','product.product_name','product.added_date','product.status' ,'product.stocked','product.expirable','product_category.category_id as pro_id', 'product_category.category_name as category')
        ->orderBy('product.added_date', 'asc') 
        ->paginate(5);
        // ->get();

        return view('product.create', compact('category', 'products'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'product_name' => 'required|min:3|max:50',
            'product_description' => 'nullable',
            'manufacturer' => 'required',
            'category' => 'required',
            'sub_category' => 'nullable',
            'sales_type' => 'required',
            'expirable' => 'required',
            'stockable' => 'required',
            'status' => 'required|min:3|max:50',
        ]); 

        $existing_product = Product::where('product_name', $request->input('product_name')) ->first();
       
        if ($existing_product)
        {
            return 200;
         }

        $pro_id = $this->product_id($request);         
        $product = new Product();
        $product->product_id = $pro_id;
        $product->product_name = $request->input('product_name');
        $product->description = $request->input('product_description');
        $product->manufacturer = $request->input('manufacturer');
        $product->category_id = $request->input('category');
        $product->sales_type = $request->input('sales_type');
        $product->expirable = $request->input('expirable');
        $product->stocked = $request->input('stockable');
        $product->status = $request->input('status');
        $product->added_date = now();
        $product->user_id =  Auth::user()->user_id;
        $product->added_by =  Auth::user()->fullname;
        $product->added_id =  Auth::user()->user_id;
        $product->save();

        return 201;
    }


    private function product_id(Request $request)
    {
        // Retrieve the count of existing
        $count_payers = Product::count();
        // Extract the initials from the request
        $surname_initial = strtoupper(substr($request->input('product_name'), 0, 1));
        $firstname_initial = strtoupper(substr($request->input('category_status'), 0, 1));
        $count_plus_one = $count_payers + 1;
        $currentHour = date('H');
        $currentDay = date('d');
        $currentMonth = date('m');
        $currentYear = date('Y');
        $desiredLength = 4;
        $formatted_id = str_pad($count_plus_one, $desiredLength, '0', STR_PAD_LEFT);
        $product_id = $surname_initial.$formatted_id.$firstname_initial.$currentHour.$currentDay.$currentMonth.$currentYear;
        return $product_id;
    }

    public function show()
    {

    }

    public function edit($product_id)
    {
        $product = Product::find($product_id);
        return response()->json(['product'=> $product]);
    
    }

    public function update(Request $request, $product_id)
    {
        $request->validate([
            'product_name' => 'required|string|max:30|min:3',
            'category' => 'required|string',
            'product_description' => 'required|string|max:30|min:3',
            'manufacturer' => 'required|string',
            'expirable' => 'string',
            'stockable' => 'string',
            'sales_type' => 'string',
            'status' => 'required|string',
        ]);

        $product = Product::findOrFail($product_id);
        $product->product_name = $request->input('product_name');
        $product->category_id = $request->input('category');
        $product->description = $request->input('product_description');
        $product->manufacturer = $request->input('manufacturer');
        $product->expirable = $request->input('expirable');
        $product->stocked = $request->input('stockable');
        $product->sales_type = $request->input('sales_type');
        $product->updated_by =  Auth::user()->user_id;
        $product->updated_date = now();
        $product->status = $request->input('status');
        $product->update($request->all());

        return 201;
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
        ]);
            
            // $prices = ProductPrice::where('product_id', $request->input('product_id')) ->first();
            // $stocks = ProductStock::where('product_id', $request->input('product_id')) ->first();
            
            // if($stocks || $prices)
            // {
            //     return 200;
            // }
            $product = Product::find($request->product_id);
            $product->delete();
            return 201;
    }

}
