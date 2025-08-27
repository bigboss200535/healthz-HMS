<?php

namespace App\Http\Controllers;

use App\Models\ConsultingRoom;
use App\Models\Patient;
use App\Models\PatientAttendance;
use App\Models\Stores;
use App\Models\Services;
use App\Models\User;
use App\Models\PatientDiagnosis;
use App\Models\Claim;
use App\Models\Product;
use App\Models\Consultation;
use App\Models\ServiceRequest;
use App\Models\AgeGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    
    // public function index()
    // {
    //   $pat_req = PatientAttendance::where('patient_attendance.archived', 'No')
    //       ->rightJoin('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
    //       ->RightJoin('gender', 'patient_info.gender_id', 'gender.gender_id')       
    //       ->orderBy('patient_attendance.attendance_id', 'asc')
    //       ->select('patient_attendance.*', 'patient_info.*', 'gender.gender',  
    //         DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as pat_ages'))
    //       ->get();  

    //       return view('consultation.index', compact('pat_req'));  
    // }
     public function index(Request $request)
    {
        $start_date = $request->input('start_date', date('Y-m-d'));
        $end_date = $request->input('end_date', date('Y-m-d'));

            $waiting = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                // ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
                ->select(
                        'patient_attendance.attendance_id',
                         DB::raw('upper(patient_info.fullname) as fullname'),
                        'patient_info.gender_id', 
                        'patient_attendance.opd_number', 
                        'patient_attendance.attendance_date', 
                        'patient_attendance.status', 
                        // 'sponsors.sponsor_name',
                        'patient_attendance.full_age', 'gender.gender', 'service_attendance_type.attendance_type as clinic', 
                        // 'sponsor_type.sponsor_type as sponsor', 
                        'sponsor_type.sponsor_type_id as sponsor_type_id',
                        'sponsor_type.sponsor_type as sponsor_type',
                        'patient_attendance.issue_id' ,'patient_attendance.attendance_type')
                // ->whereIn('patient_attendance.issue_id', ['0', '1'])
                // ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                 ->where('patient_attendance.issue_id', '=', '0')
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();

            $pending = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                // ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
                ->select(
                        'patient_attendance.attendance_id',
                         DB::raw('upper(patient_info.fullname) as fullname'),
                        'patient_info.gender_id', 
                        'patient_attendance.opd_number', 
                        'patient_attendance.attendance_date', 
                        'patient_attendance.status', 
                        // 'sponsors.sponsor_name',
                        'patient_attendance.full_age', 'gender.gender', 'service_attendance_type.attendance_type as clinic', 
                        // 'sponsor_type.sponsor_type as sponsor', 
                        'sponsor_type.sponsor_type_id as sponsor_type_id',
                        'sponsor_type.sponsor_type as sponsor_type',
                        'patient_attendance.issue_id' ,'patient_attendance.attendance_type')
                // ->whereIn('patient_attendance.issue_id', ['0', '1'])
                // ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                 
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();

            $on_hold = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                // ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
                ->select(
                        'patient_attendance.attendance_id',
                         DB::raw('upper(patient_info.fullname) as fullname'),
                        'patient_info.gender_id', 
                        'patient_attendance.opd_number', 
                        'patient_attendance.attendance_date', 
                        'patient_attendance.status', 
                        // 'sponsors.sponsor_name',
                        'patient_attendance.full_age', 'gender.gender', 'service_attendance_type.attendance_type as clinic', 
                        // 'sponsor_type.sponsor_type as sponsor', 
                        'sponsor_type.sponsor_type_id as sponsor_type_id',
                        'sponsor_type.sponsor_type as sponsor_type',
                        'patient_attendance.issue_id' ,'patient_attendance.attendance_type')
                // ->whereIn('patient_attendance.issue_id', ['0', '1'])
                // ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                 
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();

            $completed = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                // ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
                ->select(
                        'patient_attendance.attendance_id',
                         DB::raw('upper(patient_info.fullname) as fullname'),
                        'patient_info.gender_id', 
                        'patient_attendance.opd_number', 
                        'patient_attendance.attendance_date', 
                        'patient_attendance.status', 
                        // 'sponsors.sponsor_name',
                        'patient_attendance.full_age', 'gender.gender', 'service_attendance_type.attendance_type as clinic', 
                        // 'sponsor_type.sponsor_type as sponsor', 
                        'sponsor_type.sponsor_type_id as sponsor_type_id',
                        'sponsor_type.sponsor_type as sponsor_type',
                        'patient_attendance.issue_id' ,'patient_attendance.attendance_type')
                // ->whereIn('patient_attendance.issue_id', ['0', '1'])
                // ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                 
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();
            
            return view('consultation.index', compact('waiting', 'pending', 'on_hold', 'completed')); 
    }
    public function create()
    {

    }

    public function edit()
    {

    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'patient_id' => 'required|string|max:255',
            'opd_number' => 'nullable|string|max:255',
            'attendance_id' => 'required|string|max:50',
            'gender_id' => 'required|string',
            'age_id' => 'required|string',
            'patient_age' => 'required|string|min:3|max:255',
            'clinic' => 'nullable|min:3|max:255',
            'patient_status_id' => 'nullable|min:3|max:255', //inpatient or oupatient
            'sponsor_type' => 'nullable|string',
            'sponsor' => 'nullable|string|max:255',
            'episode_id' => 'nullable|string|max:50', 
            'episode_type' => 'nullable|string|max:20',
            'consulting_room' => 'nullable|string|max:100',
            'prescriber' => 'nullable|string|max:255',
            'attendance_date' => 'nullable',
            'consultation_date' => 'nullable|string|max:255',
            'consultation_type' => 'nullable|string|max:20',
            'consultation_time' => 'nullable|string|max:255',
            'service_id' => 'nullable|string|max:20',
        ]);

        $patient = $this->patient_by_id($request->input('patient_id'));
        $records_no = intval(Consultation::all()->count()) + 1;
        $age_group = AgeGroups::get_category_from_age($patient->age);
        $consult_id = intval(Consultation::all()->count()) + 1;

        // Check if the consultation already exists
        //   $existing_consultation = Consultation::where('episode_id', $validated_data['episode_id'])
        //      ->first();
        
        //  if ($existing_consultation) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Consultation record already exists for this episode'
        //     ], 422);
        //  }

        try {
                DB::beginTransaction();
            
                    $consultation_id = str_pad($consult_id, 7, '0', STR_PAD_LEFT);

                    // Create new consultation record
                    $consultation = Consultation::create([
                        'consultation_id' => $consultation_id,
                        'patient_id' => $validated_data['patient_id'],
                        'opd_number' => $validated_data['opd_number'],
                        'gender_id' => $validated_data['gender_id'],
                        'age_id' => $validated_data['age_id'],
                        'patient_age' => $validated_data['patient_age'],
                        'clinic' => $validated_data['clinic'],
                        'patient_status_id' => '2' ?? $validated_data['patient_status_id'],
                        'is_insured' => '2',
                        'pay_qty' => '2',
                        'service_id' => $validated_data['service_id'] ?? 0, 
                        'sponsor_id' => $validated_data['sponsor'],
                        'sponsor_type_id' => $validated_data['sponsor_type'],
                        'episode_id' => $validated_data['episode_id'],
                        'episode_type' => $validated_data['episode_type'],
                        'consulting_room' => $validated_data['consulting_room'],
                        'prescriber' => $validated_data['prescriber'],
                        'attendance_date' => $validated_data['attendance_date'],
                        'consultation_date' => $validated_data['consultation_date'],
                        'consultation_type' => $validated_data['consultation_type'],
                        'consultation_time' => $validated_data['consultation_time'],
                        'age_group_id' => $age_group->age_group_id,
                        'attendance_id' => $validated_data['attendance_id'],
                        'facility_id' => Auth::user()->facility_id ?? '',
                        'user_id' => Auth::user()->user_id,
                        'added_by' => Auth::user()->user_fullname ?? '',
                        'added_date' => now(),
                        'status' => 'Active',
                        'archived' => 'No'
                   ]);
            
                    // Update patient attendance status if needed
                 PatientAttendance::where('attendance_id', $validated_data['attendance_id'])
                        ->update(['issue_id' => '1']);

                DB::commit();
            
                return response()->json([
                    'status' => 'success',
                    'message' => 'Consultation saved successfully',
                ], 200);

            } catch (\Exception $e) {
                DB::rollBack();
                
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Consultation details Not Saved',
                        'error' => $e->getMessage()
                    ], 500);
            }
    }

    private function patient_by_id($patient_id)
    {
        $patient = Patient::where('archived', 'No')
            ->where('patient_id', $patient_id)
            ->select(DB::raw('TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) as age'))
            ->first();

        if(!$patient) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Patient not found'
                ], 404);
         }else if($patient){
            return $patient;
        }
    }

    public function show()
    {

    }

    public function destroy()
    {

    }
    
    /**
     * Get on-hold patients via AJAX
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOnHoldPatients(Request $request)
    {
        try {
            $start_date = $request->input('start_date', date('Y-m-d'));
            $end_date = $request->input('end_date', date('Y-m-d'));
            
            $patients = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select(
                    'patient_attendance.attendance_id',
                    'patient_info.fullname', 
                    'patient_attendance.opd_number', 
                    'patient_attendance.attendance_date', 
                    'sponsors.sponsor_name',
                    'patient_attendance.full_age', 
                    'gender.gender', 
                    'service_attendance_type.attendance_type as pat_clinic', 
                    'sponsor_type.sponsor_type as sponsor', 
                    'sponsor_type.sponsor_type_id',
                    'patient_attendance.issue_id',
                    'patient_attendance.attendance_type'
                )
                ->where('patient_attendance.archived', 'No')
                ->where('patient_attendance.issue_id', '2')
                ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();
            
            // Format the date for display
            $formattedPatients = $patients->map(function($patient) {
                $patient->formatted_date = \Carbon\Carbon::parse($patient->attendance_date)->format('d-m-Y');
                $patient->action = '<div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item resume-attendance" href="javascript:void(0);" data-id="'.$patient->attendance_id.'"><i class="bx bx-play-circle me-1"></i> Resume</a>
                                    </div>
                                </div>';
                return $patient;
            });
            
            return response()->json([
                'success' => true,
                'data' => $formattedPatients,
                'message' => 'On-hold patients retrieved successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving on-hold patients: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    
    /**
     * Get pending diagnostics patients via AJAX
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPendingDiagnostics(Request $request)
    {
        try {
            $start_date = $request->input('start_date', date('Y-m-d'));
            $end_date = $request->input('end_date', date('Y-m-d'));
            
            $patients = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select(
                    'patient_attendance.attendance_id',
                    'patient_info.fullname', 
                    'patient_attendance.opd_number', 
                    'patient_attendance.attendance_date', 
                    'sponsors.sponsor_name',
                    'patient_attendance.full_age', 
                    'gender.gender', 
                    'service_attendance_type.attendance_type as pat_clinic', 
                    'sponsor_type.sponsor_type as sponsor', 
                    'sponsor_type.sponsor_type_id',
                    'patient_attendance.issue_id',
                    'patient_attendance.attendance_type'
                )
                ->where('patient_attendance.archived', 'No')
                ->where('patient_attendance.issue_id', '1')
                ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();
            
            // Format the date for display
            $formattedPatients = $patients->map(function($patient) {
                $patient->formatted_date = \Carbon\Carbon::parse($patient->attendance_date)->format('d-m-Y');
                $patient->action = '<div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="'.url('/consultation/opd-consultation').'/'.$patient->attendance_id.'"><i class="bx bx-edit-alt me-1"></i> Consult</a>
                                        <a class="dropdown-item hold-attendance" href="javascript:void(0);" data-id="'.$patient->attendance_id.'"><i class="bx bx-pause-circle me-1"></i> Hold</a>
                                    </div>
                                </div>';
                return $patient;
            });
            
            return response()->json([
                'success' => true,
                'data' => $formattedPatients,
                'message' => 'Pending diagnostics patients retrieved successfully'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving pending diagnostics patients: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }

    public function holdAttendance($id)
    {
            try {
                // Update the issue_id field to '2' for on-hold status
                DB::table('patient_attendance')
                    ->where('attendance_id', $id)
                    ->update(['issue_id' => '2']);
                
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
    }

    public function resumeAttendance($id)
    {
            try {
                // Update the issue_id field back to '0' for pending status
                DB::table('patient_attendance')
                    ->where('attendance_id', $id)
                    ->update(['issue_id' => '0']);
                
                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()]);
            }
    }

    public function opd_consult($attendance_id)
    {
         $consultation_id = intval(Consultation::all()->count()) + 1;

        // Base query for attendance
        $attendance_query = PatientAttendance::where('patient_attendance.archived', 'No')
            ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
            ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
            ->join('ages', 'ages.age_id', '=', 'patient_attendance.age_id')
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.attendance_type_id')
            ->select(
                'patient_attendance.patient_id',
                'patient_attendance.attendance_id',
                'patient_attendance.opd_number',
                'patient_attendance.attendance_date',
                'patient_attendance.full_age',
                'patient_info.fullname',
                'ages.age_id',
                'patient_attendance.episode_id',
                'gender.gender',
                'gender.gender_id',
                'service_attendance_type.attendance_type as pat_clinic'
                )
            ->where('patient_attendance.attendance_id', $attendance_id);
               
            // Fetch the sponsor check in a single query
        $sponsor_check = PatientAttendance::where('archived', 'No')
            ->where('attendance_id', $attendance_id)
            ->first();

            if(!$sponsor_check) {
                // return response()->json('Attendance details not found.');
            }

        // Conditionally join sponsor-related tables
        if ($sponsor_check->sponsor_type_id == 'P001') 
        {
                $attendance_query->addSelect(
                    \DB::raw("'CASH PAYMENT' as sponsor_type"),
                    \DB::raw("'CASH' as sponsor")
                );

        }
         else if (in_array($sponsor_check->sponsor_type_id, ['PC04', 'N002', 'PI03'])) 
        {
            $attendance_query->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_attendance.sponsor_id')
                             ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                             ->addSelect('sponsor_type.sponsor_type as sponsor_type', 'sponsors.sponsor_name as sponsor', 
                                        'sponsor_type.sponsor_type_id', 'sponsors.sponsor_id');
        }
    
        $attendance = $attendance_query->first();
        
        $services = Services::where('archived', 'No')->get();
        // Fetch consulting rooms
        $consulting_room = ConsultingRoom::where('Archived', 'No')
            ->where('status', 'Active')
            ->get();
    
        // Fetch doctors
        $doctors = User::where('status', 'Active')
            ->where('archived', 'No')
            // ->where('role_id', 'R10')
            ->get();
        
        $systemic = DB::table('systemic_areas')
            ->where('archived', 'No')
            ->get();  

       // Fetch clinical history with their questions
        $clinical_history = DB::table('clinical_history')
            ->where('clinical_history.archived', 'No')
            ->orderBy('clinical_history_id', 'asc')
            ->get();
            
        // Fetch clinical history questions
        $clinical_history_questions = DB::table('clinical_history_question')
            ->where('archived', 'No')
            ->get();
            
        // Group questions by clinical_history_id
        $grouped_questions = [];
        foreach ($clinical_history_questions as $question) {
            $grouped_questions[$question->clinical_history_id][] = $question;
        } 

        $claims = Claim::where('attendance_id', $attendance_id)->get();

        // if(!$claims){
        //     $new_claim = Claim::create([
        //         'opd_number' => $attendance_query->opd_number,
        //         'age' => $attendance_query->pat_age,
        //         'pat_status' => $attendance_query->status_code,
        //         'attendance_date' => $attendance_query->attendance_date,
        //         'claim_start_date' => $attendance_query->attendance_date,
        //         'claims_end_date' => $attendance_query->attendance_date,
        //         // 'no_of_visits' => $attendance_query->service_type,
        //         'attendance_type' => $attendance_query->attendance_type,
        //         'gdrg' => $attendance_query->gdrg_code,
        //         'service_fee' => $attendance_query->credit_amount,
        //         'episode_id' => $attendance_query->episode_id,
        //         'user_id' => auth()->id()
        //     ]);
        // }
        // $check_status = 
        $diagnosis_history = PatientDiagnosis::where('patient_diagnosis.archived','No')
            ->where('patient_diagnosis.patient_id', $attendance->patient_id)
            ->join('users', 'users.user_id', '=', 'patient_diagnosis.doctor_id')
            ->join('diagnosis', 'diagnosis.diagnosis_id', 'patient_diagnosis.diagnosis_id')
            ->select('users.user_fullname as doctor', 'diagnosis.diagnosis', 'patient_diagnosis.icd_10', 'patient_diagnosis.gdrg_code', 'patient_diagnosis.entry_date')
            ->get();

        return view('consultation.opd_consult', compact('services', 'diagnosis_history', 'consultation_id', 'attendance', 'doctors', 'consulting_room', 'systemic', 'clinical_history', 'grouped_questions'));
    }


    public function ipd_consult()
    {

    }

    
    /**
     * Get waiting list patients via AJAX
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getWaitingList(Request $request)
    {
        try {
            $start_date = $request->input('start_date', date('Y-m-d'));
            $end_date = $request->input('end_date', date('Y-m-d'));
            
            $patients = PatientAttendance::where('patient_attendance.archived','No')
                ->join('sponsor_type', 'patient_attendance.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_attendance.patient_id')
                ->join('gender', 'gender.gender_id', '=', 'patient_info.gender_id')
                ->join('sponsors', 'patient_attendance.sponsor_id', '=', 'sponsors.sponsor_id')
                ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.service_type')
                ->select(
                    'patient_attendance.attendance_id',
                    'patient_info.fullname', 
                    'patient_attendance.opd_number', 
                    'patient_attendance.attendance_date', 
                    'sponsors.sponsor_name',
                    'patient_attendance.full_age', 
                    'gender.gender', 
                    'service_attendance_type.attendance_type as pat_clinic', 
                    'sponsor_type.sponsor_type as sponsor', 
                    'sponsor_type.sponsor_type_id',
                    'patient_attendance.issue_id',
                    'patient_attendance.attendance_type'
                )
                ->where('patient_attendance.archived', 'No')
                ->whereIn('patient_attendance.issue_id', ['0', '1'])
                ->whereBetween('patient_attendance.attendance_date', [$start_date, $end_date])
                ->orderBy('patient_attendance.attendance_id', 'desc')
                ->get();
            
            // Format the date for display
            $formattedPatients = $patients->map(function($patient) {
                $patient->formatted_date = \Carbon\Carbon::parse($patient->attendance_date)->format('d-m-Y');
                return $patient;
            });
            
            return response()->json([
                'success' => true,
                'data' => $formattedPatients,
                'message' => 'Patients retrieved successfully'
            ]);
            
        } catch (\Exception $e) {
            // \Log::error('Error fetching waiting list: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving patients: ' . $e->getMessage(),
                'data' => []
            ], 500);
        }
    }
    
    public function getSystemicSymptoms($systemic_id)
    {
        $symptoms = DB::table('systemic_symtom')
            ->where('systemic_id', $systemic_id)
            ->where('archived', 'No')
            ->where('status', 'Active')
            ->get();
        
        return response()->json($symptoms);
    }



}