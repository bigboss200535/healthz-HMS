<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facility = Facility::where('archived', 'No')->get();
        
        return view('facility.index', compact('facility'));
    }
}
