<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use App\Models\ServicePoints;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use App\Models\Title;
use App\Models\Religion;
use App\Models\Age;
use App\Models\Gender;
use App\Models\Region;
use App\Models\Relation;
use App\Models\Patient;
use App\Models\PatientSponsor;
use App\Models\PatientOpdNumber;
use App\Models\ServiceRequest;
use App\Models\Sponsors;
use App\Models\SponsorType;
use App\Models\YearlyCount;
use App\Models\Town;
use App\Models\PatientRelations;
use App\Models\Nationality;
use Carbon\Carbon;
use App\Models\Sponsor;
use App\Helpers\TimeManagement;


class PatientController extends Controller
{
    public function index()
    {
        // $sponsor_types = SponsorType::select('sponsor_type')
        //     ->where('archived', 'No')
        //     ->orderBy('sponsor_type', 'asc')
        //     ->get();
            
        // return view('patient.index', compact('sponsor_types')); 
         return view('patient.index'); 
    }

    public function create()
    {
        $today = date('Y-m-d');

        $patient = Patient::where('archived', 'No')// ->where('added_date', $today)
            ->orderBy('added_date', 'desc')->get();

        $nationality = Nationality::where('archived', 'No')->where('status', '=','Active')->get();
        $title = Title::where('archived', 'No')->where('status', '=','Active')->get();
        $religion = Religion::where('archived', 'No')->where('status', '=','Active')->get();
        $gender = Gender::where('archived', 'No')->where('status', '=','Active')->where('usage', '=','1')->get();
        $region = Region::where('archived', 'No')->where('status', '=','Active')->orderBy('region', 'asc')->get();
        $relation = Relation::where('archived', 'No')->where('status', '=','Active')->orderBy('relation', 'asc')->get();
        $towns = Town::where('archived', 'No')->where('status', '=','Active')->orderBy('towns', 'asc')->get();
        $service_points = DB::table('service_points')->where('archived', 'No')->where('status', '=', 'Active')->orderBy('service_points', 'asc')->get();
        $occupations = DB::table('occupation')->Where('status', '=', 'Active')->where('archived', 'No')->orderBy('occupation', 'asc')->get();
        $payment_type = SponsorType::where('archived', 'No')->orderBy('sponsor_type', 'DESC')->get();
        $sponsor =  DB::table('sponsors')->Where('status', '=', 'Active')->where('archived', 'No')->orderBy('sponsor_name', 'asc')->get();

        $clinic_attendance = ServicePoints::select('service_point_id','service_points')
                ->where('archived', 'No')
                ->where('is_active', 'Yes')
                ->orderBy('service_points', 'asc') 
                ->get();

        return view('patient.create', compact('nationality','patient', 'clinic_attendance', 'title', 'religion', 'gender', 'region', 'relation', 'payment_type', 'towns','occupations', 'sponsor'));
    }

   
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            '_token' => 'required|string',
            // 'old_folder' => 'nullable|string|max:255',
            'pat_id' => 'nullable',
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|min:3|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|min:3|max:255',
            'birth_date' => 'required|date',
            'gender_id' => 'required|in:2,3',
            'occupation' => 'nullable|string|max:255',
            'education' => 'required|string|min:3|max:255',
            'religion' => 'nullable|min:3|max:255',
            'nationality' => 'required|integer',
            'ghana_card' => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:20',
            'work_telephone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'region' => 'nullable|string|max:255',
            'contact_person' => 'nullable|array',
            'contact_person.*' => 'nullable|string|max:255',
            'contact_telephone' => 'nullable|array',
            'contact_telephone.*' => 'nullable|string|max:20',
            'contact_relationship' => 'nullable|array',
            'contact_relationship.*' => 'nullable|string|max:255',
            'folder_clinic' => 'nullable|string|min:3|max:255',
            'sponsor_id' => 'nullable',
            'member_no' => 'nullable|string|max:255',
            'clinic_type' => 'nullable|string|max:255',
            'opd_type' => 'nullable|string|max:255',
            'opd_number' => 'nullable|string|max:255',
            'sponsor_type_id' => 'nullable|string|max:255',
            'dependant' => 'nullable',
            'card_start_date' => 'nullable|date',
            'card_end_date' => 'nullable|date',
        ]);

        // Check if the patient already exists
        $existing_patient = Patient::where([
            ['lastname', $validated_data['lastname']],
            ['firstname', $validated_data['firstname']],
            ['birth_date', $validated_data['birth_date']],
            ['telephone', $validated_data['telephone']],
        ])->first();

        if ($existing_patient) {
            return response()->json([
                'message' => 'Patient data available',
                'code' => 200
                ], 200);
        }
        
        // $sponsor_records = intval(PatientSponsor::all()->count()) + 1;
        $patient_records = intval(Patient::all()->count()) + 1;
        // $sponsor_records = intval(PatientOpdNumber::all()->count()) + 1;

        DB::beginTransaction();
                    try {
                        $now = now();
                        $patient_id_no = Str::uuid();
                        $transaction_id = date('YmdHis');
                        $user_id = Auth::user()->user_id;
                        
                        // new patient 
                            Patient::create([
                            'patient_id' => $patient_id_no,
                            'title_id' => strtoupper($validated_data['title']),
                            'firstname' => strtoupper($validated_data['firstname']),
                            'middlename' => strtoupper($validated_data['middlename'] ?? ''),
                            'lastname' => strtoupper($validated_data['lastname']),
                            'birth_date' => $validated_data['birth_date'],
                            'gender_id' => $validated_data['gender_id'],
                            'occupation_id' => $validated_data['occupation'] ?? '',
                            'education' => strtoupper($validated_data['education']),
                            'religion_id' => $validated_data['religion'],
                            'nationality_id' => $validated_data['nationality'],
                            'ghana_card' => $validated_data['ghana_card'],
                            'old_folder' => $validated_data['old_folder'] ?? null,
                            'telephone' => $validated_data['telephone'] ?? null,
                            'work_telephone' => $validated_data['work_telephone'] ?? null,
                            'email' => $validated_data['email'] ?? null,
                            'address' => strtoupper($validated_data['address'] ?? ''),
                            'town' => strtoupper($validated_data['town'] ?? ''),
                            'region' => strtoupper($validated_data['region'] ?? ''),
                            'added_date' => $now,
                            'opd_type' => $validated_data['opd_type'],
                            'records_id' => $patient_records,
                            'user_id' =>  $user_id,
                        ]);
                       
                          // Save OPD number
                        PatientOpdNumber::create([
                            'patient_id' => $patient_id_no,
                            'opd_number' => $validated_data['opd_number'] ?? null,
                            'clinic_id' => $validated_data['folder_clinic'] ?? null,
                            'year' =>  $current_year = date('Y'),
                            'month' => $current_year = date('m'),
                            'registration_date' => $now,
                            'registration_time' => $now,
                            'user_id' =>  $user_id,
                            'added_date' => $now,
                        ]);

                        // Save multiple emergency contacts
                        if (!empty($validated_data['contact_person'])) {
                            foreach ($validated_data['contact_person'] as $index => $contact) {
                                PatientRelations::create([
                                    'patient_id' => $patient_id_no,
                                    'opd_number' => $validated_data['opd_number'] ?? null,
                                    'relation_name' => $validated_data['contact_person'][$index] ?? '',
                                    'relation_id' => $validated_data['contact_relationship'][$index] ?? '',
                                    'contact' => $validated_data['contact_telephone'][$index] ?? null,
                                    'user_id' => $user_id,
                                    'added_date' => $now,
                                ]);
                            }
                        }

                        // Check and save sponsor information
                        $sponsor_types = ['PI03', 'N002', 'PC04'];

                        if (in_array($validated_data['sponsor_type_id'] ?? '', $sponsor_types)) {

                            PatientSponsor::create([
                                'patient_id' => $patient_id_no,
                                'opd_number' => $validated_data['opd_number'],
                                'sponsor_type_id' => $validated_data['sponsor_type_id'],
                                'sponsor_id' => $validated_data['sponsor_id'],
                                'member_no' => $validated_data['member_no'],
                                'start_date' => $validated_data['card_start_date'],
                                'end_date' => $validated_data['card_end_date'],
                                'priority' => '1' ?? '0',
                                'dependant' => $validated_data['dependant'],
                                'user_id' =>  $user_id,
                                'added_date' => $now,
                                'status' => 'Active',
                            ]);
                        }

            DB::commit();

                    return response()->json([
                        'message' => 'Patient saved with Id: ' . $validated_data['opd_number'],
                        'code' => 201,
                        // 'opd_number' => $validated_data['opd_number'] ?? null,
                    ], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            
                    return response()->json([
                        'message' => 'Error saving patient details',
                        'error' => $e->getMessage()
                    ], 500);
        }
    }

    private function get_age_full($birthdate)
    {
        if (empty($birthdate)) {
            return "N/A";
        }
       
        $dob = Carbon::parse($birthdate); 
        $today = Carbon::now();
        $age_in_days = $dob->diffInDays($today);

        $dob = Carbon::parse($birthdate); 
        $today = Carbon::now();
        $age_in_days = $dob->diffInDays($today);

        if ($age_in_days < 7) {
            return $age_in_days == 1 ? "1 DAY" : "$age_in_days DAYS";
        } 
        if ($age_in_days < 30) {
            $age_in_weeks = floor($age_in_days / 7);
            return $age_in_weeks == 1 ? "1 WEEK" : "$age_in_weeks WEEKS";
        } 
        if ($age_in_days < 365) {
            $age_in_months = $dob->diffInMonths($today);
            return $age_in_months == 1 ? "1 MONTH" : "$age_in_months MONTHS";
        }
        
        $age_in_years = $dob->diffInYears($today);
        return $age_in_years == 1 ? "1 YEAR" : "$age_in_years YEARS";
    }


    public function show(Patient $patient)
    {
        $age_full = $this->get_age_full($patient->birth_date);

        // $patients = DB::table('patient_info')
        $patients = Patient::where('patient_info.patient_id', $patient->patient_id)
            ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
            ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id')
            ->join('users', 'patient_info.user_id', '=', 'users.user_id')
            ->select('patient_info.patient_id', 
                    'patient_nos.opd_number', 
                    'patient_info.title_id', 
                    'patient_info.fullname', 
                    'gender.gender', 
                    'patient_info.birth_date', 
                    'patient_info.email', 
                    'patient_info.ghana_card',
                    'patient_info.address', 
                     'patient_info.added_date', 
                     'patient_info.telephone', 
                     'users.user_fullname', 
                     'patient_info.gender_id', 
                     'patient_info.death_status',
                     DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as patient_age'))
            ->orderBy('patient_info.added_date', 'asc') 
            ->first();

        $ages = Age::where('min_age', '<=', $patients->patient_age)
            ->where('max_age', '>=', $patients->patient_age)
            ->where('max_age', '>=', $patients->patient_age)
            ->where('usage', '0')
            ->first();

        $clinic_attendance = ServicePoints::select('service_point_id', 'service_points', 'gender_id', 'age_id')
                    ->where(function ($query) use ($patients) {
                        $query->where('gender_id', $patients->gender_id)
                            ->orWhere('gender_id', 1); //  1 is a all gender group
                    })
                    ->where(function ($query) use ($ages) {
                        $query->where('age_id', $ages->age_id)
                            ->orWhere('age_id', 3); //  3 is a all age group
                    })
                    ->where('archived', 'No')
                    ->where('is_active', 'Yes')
                    ->get();
  
        $patient_sponsor = PatientSponsor::where('patient_sponsorship.opd_number', $patients->opd_number)
                    ->where('patient_sponsorship.priority', '1')
                    ->where('patient_sponsorship.archived', 'No')
                    ->where('patient_sponsorship.status', 'Active')
                    ->first();

        if (!$patient_sponsor) {
            $patient_payments = (object)[
                'sponsor_name' => 'CASH PAYMENT',
                'sponsor_type' => 'CASH PAYMENT'
            ];
        }else
        {
            $patient_payments = PatientSponsor::where('patient_sponsorship.opd_number', $patients->opd_number)
                    ->join('sponsors', 'sponsors.sponsor_id', '=', 'patient_sponsorship.sponsor_id')
                    ->join('sponsor_type', 'patient_sponsorship.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
                    ->where('patient_sponsorship.priority', '1')
                    ->where('patient_sponsorship.archived', 'No')
                    ->where('patient_sponsorship.status', 'Active')
                    ->select('sponsor_name', 'sponsor_type', 'member_no')
                    ->first();
        }

        $relatives = PatientRelations::where('patient_relations.archived', 'No')
                ->rightJoin('relation', 'relation.relation_id', '=', 'patient_relations.relation_id')
                ->where('patient_relations.patient_id', $patients->patient_id)
                ->get();

        // $request_episode = ServiceRequest::count();
        // $new_number = $request_episode + 1;
        // $episode = str_pad($new_number, 6, '0', STR_PAD_LEFT);

        return view('patient.show', compact('patients', 'clinic_attendance', 'age_full', 'patient_payments', 'relatives'));
        
    }

    
    public function edit($patient_id)
    {  
       $patient = Patient::where('patient_info.patient_id', $patient_id)
            ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
            ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id')
            ->join('occupation', 'occupation.occupation_id', '=', 'patient_info.occupation_id')
            ->select(
                    'patient_info.patient_id',
                    'patient_info.title_id',
                    'patient_info.firstname',
                    'patient_info.middlename',
                    'patient_info.lastname',
                    'patient_info.birth_date',
                    'patient_info.gender_id',
                    'patient_info.occupation_id',
                    'occupation.occupation',
                    'patient_info.religion_id as religion',
                    'patient_info.nationality_id as nationality',
                    'patient_info.ghana_card',
                    'patient_info.education',
                    'patient_info.telephone',
                    'patient_info.work_telephone',
                    'patient_info.email',
                    'patient_info.address',
                    'patient_info.town',
                    'patient_info.region',
                    'patient_nos.opd_number',
                    'patient_nos.clinic_id as folder_clinic',
                    'patient_info.opd_type',
                    DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as patient_age'))
            ->first();

    if (!$patient) {
        return response()->json(['error' => 'Patient not found'], 404);
    }

    // Fetch sponsor details if exists
    $sponsor = PatientSponsor::where('patient_id', $patient_id)
        ->where('priority', '1')
        ->where('archived', 'No')
        ->where('status', 'Active')
        ->first();
    
   // Fetch all emergency contacts
    $relations = PatientRelations::where('patient_id', $patient_id) 
        ->where('archived', 'No') 
        ->where('status', 'Active') 
        ->get(); 

    // emergency contacts for JSON response
    $emergency_contacts = [];
        foreach ($relations as $relation) {
            $emergency_contacts[] = [
                // 'relation_id' =>$relations->
                'relation_name' => $relation->relation_name,
                'relation_id' => $relation->relation_id,
                'contact' => $relation->contact
            ];
    }

    $response = [
        'patient_id' => $patient->patient_id,
        'title_id' => $patient->title_id,
        'firstname' => $patient->firstname,
        'middlename' => $patient->middlename,
        'lastname' => $patient->lastname,
        'birth_date' => $patient->birth_date,
        'gender_id' => $patient->gender_id,
        'occupation' => $patient->occupation,
        'education' => $patient->education,
        'religion' => $patient->religion,
        'nationality' => $patient->nationality,
        'ghana_card' => $patient->ghana_card,
        'telephone' => $patient->telephone,
        'work_telephone' => $patient->work_telephone,
        'email' => $patient->email,
        'address' => $patient->address,
        'town' => $patient->town,
        'region' => $patient->region,
        'sponsor_type_id' => $sponsor->sponsor_type_id ?? null,
        'sponsor_id' => $sponsor->sponsor_id ?? null,
        'member_no' => $sponsor->member_no ?? null,
        'dependant' => $sponsor->dependant ?? 'NO',
        'start_date' => $sponsor->start_date ?? null,
        'end_date' => $sponsor->end_date ?? null,
        'card_status' => $sponsor->status ?? 'Active',
        'opd_type' => $patient->opd_type,
        'pat_age' => $patient->patient_age,
        'folder_clinic' => $patient->folder_clinic,
        'opd_number' => $patient->opd_number,
         // Add the emergency contacts array to the response
        'emergency_contacts' => $emergency_contacts
    ];

    return response()->json($response); 

        
    }

    public function update(Request $request, $pat_id)
    {
        $data = $request->validate([
            '_token' => 'required|string',
            'pat_id' => 'nullable',
            'title' => 'required',
            'firstname' => 'required|min:3',
            'middlename' => 'nullable',
            'lastname' => 'required|min:3',
            'birth_date' => 'required',
            'gender_id' => 'required',
            'occupation' => 'required|min:3',
            'education' => 'required|min:3',
            'religion' => 'required',
            'nationality' => 'required',
            'old_folder' => 'nullable',
            'telephone' => 'nullable',
            'work_telephone' => 'nullable',
            'email' => 'nullable',
            'address' => 'nullable',
            'town' => 'nullable',
            'region' => 'nullable',
            'contact_person' => 'nullable',
            'contact_telephone' => 'nullable',
            'contact_relationship' => 'nullable',
            'sponsor_type' => 'nullable',
            'sponsor_name' => 'nullable',
            'member_no' => 'nullable',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'dependant' => 'nullable',
        ]);

        $pat = Patient::findOrFail($pat_id);
        $pat->updated_by =  Auth::user()->user_id;
        $pat->updated_date = now();
        $pat->status = $request->input('category_status');
        $pat->lockForUpdate($request->all());

        return 201;
    }

    public function destroy(Request $request)
    {
       

    }


    public function search_patients(Request $request)
    {
            $search_type = $request->input('search_type', 'basic');

            if ($search_type === 'basic') 
            {
                // Basic search functionality
                $search_term = $request->input('search_patient');
                // Step 1: Search in the Patient table
                $search_patient = Patient::query()
                ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id',)
                    ->where(function ($query) use ($search_term) {
                        $query->where('telephone', 'like', '%' . $search_term . '%');
                    })
                    // ->get();
                    ->paginate(50);
                // Step 2: If no results are found in the Patient table, search in the PatientSponsor table
                if ($search_patient->isEmpty()) {
                    $search_patient = PatientSponsor::query()
                    ->join('patient_info', 'patient_info.patient_id', '=', 'patient_sponsorship.patient_id')
                        ->where(function ($query) use ($search_term) {
                            $query->where('opd_number', 'like', '%' . $search_term . '%')
                                ->orWhere('member_no', 'like', '%' . $search_term . '%');
                        })
                        // ->get();
                        ->paginate(50);
                    // Step 3: If no results are found in the PatientSponsor table, search in the PatientOpdNumber table
                    if ($search_patient->isEmpty()) {
                        $search_patient = PatientOpdNumber::query()
                        ->join('patient_info', 'patient_info.patient_id', '=', 'patient_nos.patient_id')
                            ->where(function ($query) use ($search_term) {
                                $query->where('opd_number', 'like', '%' . $search_term . '%');
                            })
                            ->distinct()
                            // ->get();
                            ->paginate(50);
                    }
                }
            } else {
                // Advanced search functionality
                $search_term = $request->input('search_patient');
                // Step 1: Search in the Patient table
                $search_patient = Patient::query()
                ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id',)
                    ->where(function ($query) use ($search_term) {
                        $query->where('firstname', 'like', '%' . $search_term . '%')
                        ->orWhere('lastname', 'like', '%' . $search_term . '%')
                        ->orWhere('address', 'like', '%' . $search_term . '%')
                        ->orWhere('email', 'like', '%' . $search_term . '%');
                    })
                    ->get();
                // Step 2: If no results are found in the Patient table, search in the PatientSponsor table
                if ($search_patient->isEmpty()) {
                    $search_patient = PatientSponsor::query()
                    ->join('patient_info', 'patient_info.patient_id', '=', 'patient_sponsorship.patient_id')
                        ->where(function ($query) use ($search_term) {
                            $query->where('opd_number', 'like', '%' . $search_term . '%')
                                ->orWhere('member_no', 'like', '%' . $search_term . '%')
                                ->orWhere('sponsor_id', 'like', '%' . $search_term . '%')
                                ->orWhere('sponsor_type_id', 'like', '%' . $search_term . '%');
                        })
                        ->get();
                    // Step 3: If no results are found in the PatientSponsor table, search in the PatientOpdNumber table
                    if ($search_patient->isEmpty()) {
                        $search_patient = PatientOpdNumber::query()
                        ->join('patient_info', 'patient_info.patient_id', '=', 'patient_nos.patient_id')
                            ->where(function ($query) use ($search_term) {
                                $query->where('opd_number', 'like', '%' . $search_term . '%');
                            })
                            
                            ->get();
                    }
                }
            }

            // Return the search results in JSON format
            return response()->json($search_patient);
    }


    public function generate_opd_number(Request $request, $service_point_id)
    {
        $current_year = date('Y');
        $small_year = date('y');

            if($request->input('opd_type')=='1')// if type == new
            {
                    $service_points = DB::table('service_points') // Fetch the service point details
                        ->select('folder_prefix', 'folder_lenght')
                        ->where('archived', 'No')
                        ->where('status', 'Active')
                        ->where('service_point_id', $service_point_id)
                        ->first();
                    
                    $patient_nos = DB::table('patient_nos')// Fetch the patient count for the current year
                        ->where('clinic_id', $service_point_id)
                        ->whereYear('added_date', $current_year) // Ensure to filter by the current year
                        ->count();

                    if(!$service_points) {
                      return response()->json(['success' => false, 'message' => 'Invalid service point.'], 400);
                    }

                    $initial_letter = $service_points->folder_prefix;
                    $number_lenght = intval($service_points->folder_lenght);
                    $patient_nos = ($patient_nos == 0) ? 1 : $patient_nos + 1; // If no patients exist for the current year, start from 1
                    $formatted_id = str_pad($patient_nos, $number_lenght, '0', STR_PAD_LEFT);// Format the incremented count as a 6-digit number with leading zeros
                    $patient_number = $initial_letter . $formatted_id ."/". $small_year;// Generate the patient number
                    
                    return response()->json([
                        'success' => true,
                        'code' => 201,
                        'result' => $patient_number
                    ]);

            }
            else if($request->input('opd_type')=='0')// if type ==old leave blank
            {
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'result' => ''
                ]);
            }

    }


    public function get_patient_sponsor($patient_id)
    {
         $sponsor = DB::table('patient_sponsorship')
            ->where('patient_sponsorship.archived', 'No')
            ->where('patient_id', $patient_id)
            ->join('sponsors', 'patient_sponsorship.sponsor_id', '=', 'sponsors.sponsor_id')
            ->join('sponsor_type', 'sponsor_type.sponsor_type_id', '=', 'sponsors.sponsor_type_id')
            ->select('sponsor_type.sponsor_type','patient_sponsorship.member_no', 'patient_sponsorship.sponsor_id', 'sponsors.sponsor_name', 
                    'patient_sponsorship.start_date', 'patient_sponsorship.end_date', 
                    'patient_sponsorship.status', 'patient_sponsorship.priority', 'patient_sponsorship.is_active' )
            ->get();

        return response()->json($sponsor);
    }

    public function list_all_patient_sponsors(Request $request)
    {
         $sponsor_list = DB::table('patient_sponsorship')
            ->where('patient_sponsorship.archived', 'No')
            ->join('sponsors', 'patient_sponsorship.sponsor_id', '=', 'sponsors.sponsor_id')
            ->join('patient_info', 'patient_info.patient_id', '=', 'patient_sponsorship.patient_id')
            ->join('sponsor_type', 'sponsor_type.sponsor_type_id', '=', 'sponsors.sponsor_type_id')
            ->select('patient_info.fullname', 'patient_sponsorship.sponsor_type_id','sponsor_type.sponsor_type','patient_sponsorship.member_no', 
                     'patient_sponsorship.sponsor_id', 'sponsors.sponsor_name', 
                    'patient_sponsorship.start_date', 'patient_sponsorship.end_date', 'patient_sponsorship.added_date', 
                    'patient_sponsorship.status as card_status', 'patient_sponsorship.status', 'patient_sponsorship.priority', 
                    'patient_sponsorship.is_active', 'sponsors.sponsor_name', 'sponsor_type.sponsor_type' )
            ->get();

            return view('patient.sponsors', compact('sponsor_list'));
    }

    public function recent_patient_registration()
    {
        $get_date = date('Y-m-d');
        $recent_patient = Patient::where('archived', 'No')
             ->where('added_date', $get_date)
             ->orderBy('added_date', 'desc')
             ->paginate(10);
        //    ->get();

         return response()->json($recent_patient);
    }
      
    public function exports()
    {
        $patients = Patient::all();
        $filename = 'patients_' . date('Y-m-d') . '.csv';

        $header = [
            'Content-Type'
        ];
    }
}
