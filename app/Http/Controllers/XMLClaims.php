<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Medicine;
use App\Models\PatientDiagnosis;
use App\Models\PatientProcedure;
use App\Models\Claim; // Add the Claim model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use SimpleXMLElement;

class ExportController extends Controller
{
    public function downloadXml()
    {
        // Fetch all claims with their related patient, medicines, diagnoses, and procedures
        $claims = Claim::with(['patient.medicines', 'patient.diagnoses', 'patient.procedures'])->get();

        // Create the root XML element
        $xml = new SimpleXMLElement('<?xml version="1.0"?><claims></claims>');

        // Loop through each claim and add its data to the XML
        foreach ($claims as $claim) {
            $claimNode = $xml->addChild('claim');

            // Add claim details
            $claimNode->addChild('claimID', $claim->id);
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
            if ($claim->principal_gdrg=='Yes') {
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
}