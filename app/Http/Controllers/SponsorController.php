<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Title;
use App\Models\Religion;
use App\Models\Gender;
use App\Models\Region;
use App\Models\Relation;
use App\Models\Patient;
use App\Models\PatientSponsor;
use App\Models\PatNumber;
use App\Models\YearlyCount;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SponsorController extends Controller
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

    public function get_sponsors_by_type(Request $request)
    {
        $sponsor_type_id = $request->input('sponsor_type_id');
        
        // Query sponsors based on sponsor type
        $sponsors = DB::table('sponsors')
                      ->where('sponsor_type_id', $sponsor_type_id)
                      ->where('archived', 'No')
                      ->get(['sponsor_id', 'sponsor_name']);
        
        return response()->json($sponsors);
    }
}
