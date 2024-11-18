<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;


class Claims extends Controller
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

    public function generate_claims()
    {
        $lock = Cache::lock('generate_claims', 360);
            if($lock->get())
            {
                try {
                    Log::info('Generating Claims');
                    $data = $this->gather_date();
                    $process_data = $this->process_data($data);
                    $report = $this->create_report($process_data);
                    $this->sendReport($report);
                    Log::info('Claims generated successfully');
                } catch (\Exception $e) {
                    Log::error('Error generated claims: ' . $e->getMessage());
                } finally{
                    $lock->release();
                   
                }
            }else{
                 Log::info('Claims generation in progress');
            }
    }

    public function xml_claims_generation()
    {
        $claims = Claim::with('patient', 'consultation', 'prescriptions')->get();
    }

}
