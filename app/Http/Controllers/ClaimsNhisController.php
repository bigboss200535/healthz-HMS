<?php

namespace App\Http\Controllers;

use App\Models\Claim;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use SimpleXMLElement;


class ClaimsNhisController extends Controller
{
  
    public function index()
    {
        $specialties = Specialty::where('archived', 'No')
        ->orderBy('mdc', 'asc')
        ->get();
        
        return view('claims.nhis.index', compact('specialties')); 
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

    public function generate_claims_xml(Request $request)
    {
        // Fetch all claims with their related patient, medicines, diagnoses, and procedures
        $claims = Claim::with(['patient.medicines', 'patient.diagnoses', 'patient.procedures'])->get();

        // Create the root XML element
        $xml = new SimpleXMLElement('<?xml version="1.0"?><claims></claims>');

        // Loop through each claim and add its data to the XML
        foreach ($claims as $claim) {
            $claimNode = $xml->addChild('claim');

            // Add claim details
            $claimNode->addChild('claimID', $claim->claim_id);
            $claimNode->addChild('claimCheckCode', $claim->claim_check_code);
            $claimNode->addChild('memberNo', $claim->patient->member_no);
            $claimNode->addChild('cardSerialNo', $claim->patient->card_serial_no);
            $claimNode->addChild('surname', $claim->patient->surname);
            $claimNode->addChild('otherNames', $claim->patient->other_names);
            $claimNode->addChild('dateOfBirth', $claim->patient->date_of_birth);
            $claimNode->addChild('gender', $claim->patient->gender);
            $claimNode->addChild('hospitalRecNo', $claim->patient->hospital_rec_no);
            $claimNode->addChild('isDependant', $claim->patient->is_dependant);
            $claimNode->addChild('typeOfService', $claim->patient->type_of_service);
            $claimNode->addChild('isUnbundled', $claim->patient->is_unbundled);
            $claimNode->addChild('includesPharmacy', $claim->patient->includes_pharmacy);

            // Add claim-specific details
            $claimNode->addChild('typeOfAttendance', $claim->type_of_attendance);
            $claimNode->addChild('serviceOutcome', $claim->service_outcome);

            // Add dates of service
            foreach ($claim->dates_of_service as $date) {
                $claimNode->addChild('dateOfService', $date);
            }

            $claimNode->addChild('specialtyAttended', $claim->specialty_attended);

            // Add diagnoses
            foreach ($claim->patient->diagnoses as $diagnosis) {
                $diagnosisNode = $claimNode->addChild('diagnosis');
                $diagnosisNode->addChild('gdrgCode', $diagnosis->gdrg_code);
                $diagnosisNode->addChild('icd10', $diagnosis->icd10);
                $diagnosisNode->addChild('diagnosis', $diagnosis->diagnosis);
            }

            // Add medicines
            foreach ($claim->patient->medicines as $medicine) {
                $medicineNode = $claimNode->addChild('medicine');
                $medicineNode->addChild('serviceDate', $medicine->service_date);
                $medicineNode->addChild('medicineCode', $medicine->medicine_code);
                $medicineNode->addChild('dispensedQty', $medicine->dispensed_qty);

                $prescriptionNode = $medicineNode->addChild('prescription');
                $prescriptionNode->addChild('dose', $medicine->dose);
                $prescriptionNode->addChild('frequency', $medicine->frequency);
                $prescriptionNode->addChild('duration', $medicine->duration);
            }

            // Add procedures
            foreach ($claim->patient->procedures as $procedure) {
                $procedureNode = $claimNode->addChild('procedure');
                $procedureNode->addChild('serviceDate', $procedure->service_date);
                $procedureNode->addChild('gdrgCode', $procedure->gdrg_code);
                $procedureNode->addChild('icd10', $procedure->icd10);
                $procedureNode->addChild('diagnosis', $procedure->diagnosis);
            }

            // Add principal GDRG if exists
            if ($claim->principal_gdrg) {
                $claimNode->addChild('principalGDRG', $claim->principal_gdrg);
            }
        }

        // Convert the XML object to a string
        $xmlString = $xml->asXML();

        // Set headers for file download
        $headers = [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="claims_export.xml"',
        ];

        // Return the XML file as a download response
        return Response::make($xmlString, 200, $headers);
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
