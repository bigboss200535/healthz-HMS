<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\HealthFacilityLevels;


class FacilityController extends Controller
{
    public function index()
    {
        $facility = Facility::where('archived', 'No')->get();
        $facility_type = HealthFacilityLevels::where('archived', 'No')->get();
        $facility_details=Facility::where('archived', 'No')->first();

        return view('facility.index', compact('facility', 'facility_type', 'facility_details'));
    }
}
