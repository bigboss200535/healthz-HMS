<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsors;

class ClaimsPrivateController extends Controller
{
    public function index()
    {
        $insurance_companies = Sponsors::where('sponsor_type_id', '=', 'PI03')
            ->where('archived', 'No')
            ->get();
        
        return view('claims-private.index', compact('insurance_companies'));  
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

    public function search()
    {
        
    }

}
