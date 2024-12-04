<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;


class ClaimsController extends Controller
{
  
    public function index()
    {
        
        return view('claims.index'); 
        
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

    public function generate_vetting_claims()
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
        $xml = new SimpleXMLElement('<claims/>');

            foreach ($claims as $claim) {
                $claimXml = $xml->addChild('claim');

                // Add core claim information
                $claimXml->addChild('claimID', $claim->claim_id);
                $claimXml->addChild('membership_no', $claim->membership_no);
                // ... other core claim fields

                // Add patient demographic information
                $patientXml = $claimXml->addChild('patient');
                $patientXml->addChild('surname', $claim->patient->surname);
                $patientXml->addChild('otherNames', $claim->patient->other_names);
                // ... other patient fields

                // Add consultation information
                $consultationXml = $claimXml->addChild('consultation');
                $consultationXml->addChild('diagnosis', $claim->consultation->diagnosis);
                $consultationXml->addChild('principalGDRG', $claim->consultation->principal_gdrg);

                // Add prescription information
                foreach ($claim->prescriptions as $prescription) {
                    $medicineXml = $claimXml->addChild('medicine');
                    $medicineXml->addChild('medicineCode', $prescription->medicine_code);
                    $medicineXml->addChild('dispensedQty', $prescription->dispensed_qty);
                    // ... other prescription fields
                }
            }

            return $xml->asXML();
            }

    public function json_claims_generation()
    {
                $claims = Claim::with('patient', 'consultation', 'prescriptions')->get();

                    $jsonData = [];

                    foreach ($claims as $claim) {
                        $claimData = [
                            'claim_id' => $claim->claim_id,
                            'membership_no' => $claim->membership_no,
                            // ... other core claim fields
                            'patient' => [
                                'surname' => $claim->patient->surname,
                                'other_names' => $claim->patient->other_names,
                                // ... other patient fields
                            ],
                            'consultation' => [
                                'diagnosis' => $claim->consultation->diagnosis,
                                'principal_gdrg' => $claim->consultation->principal_gdrg,
                            ],
                            'prescriptions' => [],
                        ];

                        foreach ($claim->prescriptions as $prescription) {
                            $claimData['prescriptions'][] = [
                                'medicine_code' => $prescription->medicine_code,
                                'dispensed_qty' => $prescription->dispensed_qty,
                                // ... other prescription fields
                            ];
                        }

                        $jsonData[] = $claimData;
                    }

                    return response()->json($jsonData);
    }
            

}
