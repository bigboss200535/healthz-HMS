<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Claim;
use SimpleXMLElement;

class DownloadsController extends Controller
{
    public function downloadClaimXML(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $claims = DB::table('claims')
            ->whereBetween('end_date', [$start_date, $end_date])
            ->get();

        $timestamp = now()->format('YmdHis');
        $xml = new SimpleXMLElement('<claims/>');
        foreach ($claims as $claim) {
            $claimXml = $xml->addChild('claim');
            foreach ($claim as $key => $value) {
                $claimXml->addChild($key, htmlspecialchars($value));
            }
        }
        Storage::put($file_path, $xml->asXML());

        Storage::put($file_path, $claims->toXml());

        return response()->download($file_path);
    }

    
    public function xml_claims_generation(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        $claims = Claim::with('patient', 'consultation', 'prescriptions')
            ->whereBetween('end_date', [$start_date, $end_date])
            ->where('claim_status', 'Success')
            ->get();

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
