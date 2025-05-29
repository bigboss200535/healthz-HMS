<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Patient;
use App\Models\Religion;
use App\Models\Sponsors;
use App\Models\SponsorType;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;

class PatientReportController extends Controller
{
    public function index()
    {
        $genders = Gender::where('usage', '1')->get();
        $religions = Religion::all();
        $sponsors = Sponsors::all();
        $sponsor_types = SponsorType::all();
        $clinics = Clinic::where('status', 'Active')->get();
        
        return view('reports.patients.index', compact('genders', 'religions', 'sponsors', 'sponsor_types', 'clinics'));
    }
    
    public function generate(Request $request)
    {
        $patients = $this->getFilteredPatients($request);
        
        // For AJAX requests, return JSON response
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $patients,
                'message' => 'Patients retrieved successfully',
                'code' => 200
            ]);
        }
        
        // For non-AJAX requests, handle as before
        if ($request->report_type == 'View') 
        {
            return view('reports.patients.view', compact('patients', 'request'));
        } elseif ($request->report_type == 'PDF') 
        {
            return $this->generatePDF($patients, $request);
        } elseif ($request->report_type == 'Excel') 
        {
            return $this->generateExcel($patients, $request);
        } elseif ($request->report_type == 'Word') 
        {
            return $this->generateWord($patients, $request);
        }
        
        return back()->with('error', 'Invalid report type selected');
    }
    
    private function getFilteredPatients(Request $request)
    {
        $query = Patient::query();
        
        // Join with patient_sponsor table if sponsor filter is applied
        if ($request->sponsor_id || $request->sponsor_type_id) {
            $query->join('patient_sponsor', 'patient_info.patient_id', '=', 'patient_sponsor.patient_id');
            
            if ($request->sponsor_id) {
                $query->where('patient_sponsor.sponsor_id', $request->sponsor_id);
            }
            
            if ($request->sponsor_type_id) {
                $query->where('patient_sponsor.sponsor_type_id', $request->sponsor_type_id);
            }
        }
        
        // Apply filters
        if ($request->gender_id) {
            $query->where('gender_id', $request->gender_id);
        }
        
        if ($request->religion_id) {
            $query->where('religion_id', $request->religion_id);
        }
        
        if ($request->date_from) {
            $query->whereDate('added_date', '>=', $request->date_from);
        }
        
        if ($request->date_to) {
            $query->whereDate('added_date', '<=', $request->date_to);
        }
        
        // Add clinic filter
        if ($request->clinic_id) {
            $query->where('clinic_id', $request->clinic_id);
        }
        
        return $query->where('status', 'Active')
                    ->where('archived', 'No')
                    ->orderBy('added_date', 'desc')
                    ->get();
    }
    
    private function generatePDF($patients, $request)
    {
        $pdf = PDF::loadView('reports.patients.pdf', compact('patients', 'request'));
        
        return $pdf->download('patient_report_' . date('Y-m-d') . '.pdf');
    }
    
    private function generateExcel($patients, $request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Set headers
        $sheet->setCellValue('A1', 'OPD Number');
        $sheet->setCellValue('B1', 'Patient Name');
        $sheet->setCellValue('C1', 'Gender');
        $sheet->setCellValue('D1', 'Age');
        $sheet->setCellValue('E1', 'Religion');
        $sheet->setCellValue('F1', 'Telephone');
        $sheet->setCellValue('G1', 'Sponsor');
        $sheet->setCellValue('H1', 'Date Added');
        
        // Add data
        $row = 2;
        foreach ($patients as $patient) {
            $sheet->setCellValue('A' . $row, $patient->opd_number ?? 'N/A');
            $sheet->setCellValue('B' . $row, $patient->fullname ?? $patient->firstname . ' ' . $patient->lastname);
            $sheet->setCellValue('C' . $row, $patient->gender->gender ?? 'N/A');
            $sheet->setCellValue('D' . $row, Carbon::parse($patient->birth_date)->age ?? 'N/A');
            $sheet->setCellValue('E' . $row, $patient->religion->religion ?? 'N/A');
            $sheet->setCellValue('F' . $row, $patient->telephone ?? 'N/A');
            
            // Get sponsor info if available
            $sponsorInfo = 'N/A';
            if (isset($patient->patientSponsor) && $patient->patientSponsor->count() > 0) {
                $sponsorInfo = $patient->patientSponsor->first()->sponsor->sponsor_name ?? 'N/A';
            }
            $sheet->setCellValue('G' . $row, $sponsorInfo);
            
            $sheet->setCellValue('H' . $row, $patient->added_date ? date('Y-m-d', strtotime($patient->added_date)) : 'N/A');
            $row++;
        }
        
        // Create file
        $writer = new Xlsx($spreadsheet);
        $filename = 'patient_report_' . date('Y-m-d') . '.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $writer->save($tempFile);
        
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
    
    private function generateWord($patients, $request)
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();
        
        // Add title
        $section->addText('Patient Report', ['bold' => true, 'size' => 16], ['alignment' => 'center']);
        $section->addText('Generated on: ' . date('Y-m-d H:i:s'), ['size' => 10], ['alignment' => 'center']);
        $section->addTextBreak(1);
        
        // Add filters section
        $section->addText('Filters Applied:', ['bold' => true, 'size' => 12]);
        
        if ($request->gender_id) {
            $gender = Gender::find($request->gender_id);
            $section->addListItem('Gender: ' . ($gender->gender ?? $request->gender_id), 0);
        }
        
        if ($request->religion_id) {
            $religion = Religion::find($request->religion_id);
            $section->addListItem('Religion: ' . ($religion->religion ?? $request->religion_id), 0);
        }
        
        if ($request->sponsor_id) {
            $sponsor = Sponsors::find($request->sponsor_id);
            $section->addListItem('Sponsor: ' . ($sponsor->sponsor_name ?? $request->sponsor_id), 0);
        }
        
        if ($request->sponsor_type_id) {
            $sponsorType = SponsorType::find($request->sponsor_type_id);
            $section->addListItem('Sponsor Type: ' . ($sponsorType->sponsor_type ?? $request->sponsor_type_id), 0);
        }
        
        if ($request->date_from && $request->date_to) {
            $section->addListItem('Date Range: ' . $request->date_from . ' to ' . $request->date_to, 0);
        } elseif ($request->date_from) {
            $section->addListItem('Date From: ' . $request->date_from, 0);
        } elseif ($request->date_to) {
            $section->addListItem('Date To: ' . $request->date_to, 0);
        }
        
        $section->addTextBreak(1);
        
        // Add table
        $table = $section->addTable(['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 80]);
        
        // Add header row
        $table->addRow();
        $table->addCell(1500)->addText('OPD Number', ['bold' => true]);
        $table->addCell(2000)->addText('Patient Name', ['bold' => true]);
        $table->addCell(1000)->addText('Gender', ['bold' => true]);
        $table->addCell(800)->addText('Age', ['bold' => true]);
        $table->addCell(1500)->addText('Religion', ['bold' => true]);
        $table->addCell(1500)->addText('Telephone', ['bold' => true]);
        $table->addCell(1500)->addText('Sponsor', ['bold' => true]);
        $table->addCell(1500)->addText('Date Added', ['bold' => true]);
        
        // Add data rows
        foreach ($patients as $patient) {
            $table->addRow();
            $table->addCell(1500)->addText($patient->opd_number ?? 'N/A');
            $table->addCell(2000)->addText($patient->fullname ?? $patient->firstname . ' ' . $patient->lastname);
            $table->addCell(1000)->addText($patient->gender->gender ?? 'N/A');
            $table->addCell(800)->addText(Carbon::parse($patient->birth_date)->age ?? 'N/A');
            $table->addCell(1500)->addText($patient->religion->religion ?? 'N/A');
            $table->addCell(1500)->addText($patient->telephone ?? 'N/A');
            
            // Get sponsor info if available
            $sponsorInfo = 'N/A';
            if (isset($patient->patientSponsor) && $patient->patientSponsor->count() > 0) {
                $sponsorInfo = $patient->patientSponsor->first()->sponsor->sponsor_name ?? 'N/A';
            }
            $table->addCell(1500)->addText($sponsorInfo);
            
            $table->addCell(1500)->addText($patient->added_date ? date('Y-m-d', strtotime($patient->added_date)) : 'N/A');
        }
        
        // Create file
        $filename = 'patient_report_' . date('Y-m-d') . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), $filename);
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);
        
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }
}