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
use Carbon\Carbon;


class PatientController extends Controller
{
    public function index()
    {
        return view('patient.index'); 
    }

    public function create()
    {
        $title = Title::where('archived', 'No')->where('status', '=','Active')->get();
        $religion = Religion::where('archived', 'No')->where('status', '=','Active')->get();
        $gender = Gender::where('archived', 'No')->where('status', '=','Active')->where('usage', '=','1')->get();
        $region = Region::where('archived', 'No')->where('status', '=','Active')->get();
        $relation = Relation::where('archived', 'No')->where('status', '=','Active')->get();
        $towns = Town::where('archived', 'No')->where('status', '=','Active')->get();
        $service_points = DB::table('service_points')->where('archived', 'No')->where('status', '=', 'Active')->orderBy('service_points', 'asc')->get();
        $occupations = DB::table('occupation')->Where('status', '=', 'Active')->where('archived', 'No')->orderBy('occupation', 'asc')->get();
        $payment_type = SponsorType::where('archived', 'No')->orderBy('sponsor_type', 'DESC')->get();
        $sponsor =  DB::table('sponsors')->Where('status', '=', 'Active')->where('archived', 'No')->orderBy('sponsor_name', 'asc')->get();

        $clinic_attendance = ServicePoints::select('service_point_id','service_points')
                ->where('archived', 'No')
                ->where('is_active', 'Yes')
                ->orderBy('service_points', 'asc') 
                ->get();

        return view('patient.create', compact('clinic_attendance','title', 'religion', 'gender', 'region', 'relation', 'payment_type', 'towns','occupations', 'sponsor'));
    }

   
    public function store(Request $request)
    {
        
        $validated_data = $request->validate([
            'pat_id' => 'nullable',
            'title' => 'required|string|max:255',
            'firstname' => 'required|string|min:3|max:255',
            'middlename' => 'nullable|string|max:255',
            'lastname' => 'required|string|min:3|max:255',
            'birth_date' => 'required|date',
            'gender_id' => 'required|max:255',
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
            'contact_person' => 'nullable|string|max:255',
            'contact_telephone' => 'nullable|string|max:20',
            'contact_relationship' => 'nullable|string|max:255',
            'folder_clinic' => 'nullable|string|min:3|max:255',
            'sponsor_id' => 'nullable',
            'member_no' => 'nullable|string|max:255',
            'clinic_type' => 'nullable|string|max:255',
            'opd_number' => 'nullable|string|max:255',
            'sponsor_type_id' => 'nullable|string|max:255',
            'dependant' => 'nullable',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
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
        
        $sponsor_records = intval(PatientSponsor::all()->count()) + 1;
        $patient_records = intval(Patient::all()->count()) + 1;
        $sponsor_records = intval(PatientOpdNumber::all()->count()) + 1;

        DB::beginTransaction();
                    try {
                        $now = now();
                        $patient_id_no = Str::uuid();
                        $transaction_id = now()->format('YmdHis');
                        $user_id = Auth::user()->user_id;
                        
                        $patient = new Patient([
                            'patient_id' => $patient_id_no,
                            'title' => strtoupper($validated_data['title']),
                            'firstname' => strtoupper($validated_data['firstname']),
                            'middlename' => strtoupper($validated_data['middlename'] ?? ''),
                            'lastname' => strtoupper($validated_data['lastname']),
                            'birth_date' => $validated_data['birth_date'],
                            'gender_id' => $validated_data['gender_id'],
                            'occupation' => strtoupper($validated_data['occupation'] ?? ''),
                            'education' => strtoupper($validated_data['education']),
                            'religion_id' => $validated_data['religion'],
                            'nationality_id' => $validated_data['nationality'],
                            'old_folder' => $validated_data['old_folder'] ?? null,
                            'telephone' => $validated_data['telephone'] ?? null,
                            'work_telephone' => $validated_data['work_telephone'] ?? null,
                            'email' => $validated_data['email'] ?? null,
                            'address' => strtoupper($validated_data['address'] ?? ''),
                            'town' => strtoupper($validated_data['town'] ?? ''),
                            'region' => strtoupper($validated_data['region'] ?? ''),
                            'contact_person' => $validated_data['contact_person'] ?? null,
                            'contact_telephone' => $validated_data['contact_telephone'] ?? null,
                            'contact_relationship' => strtoupper($validated_data['contact_relationship'] ?? ''),
                            'added_date' => $now,
                            // 'records_id' => $transaction_id,
                            'records_id' => $patient_records,
                            'user_id' =>  $user_id,
                        ]);

                        $patient->save();
                          // Save OPD number
                        PatientOpdNumber::create([
                            'patient_id' => $patient_id_no,
                            'opd_number' => $validated_data['opd_number'] ?? null,
                            'clinic_id' => $validated_data['folder_clinic'] ?? null,
                            'registration_date' => $now,
                            'registration_time' => $now,
                            'user_id' =>  $user_id,
                            'added_date' => $now,
                        ]);

                        // Check and save sponsor information
                        $sponsor_types = ['PI03', 'N002', 'PC04'];

                        if (in_array($validated_data['sponsor_type_id'] ?? '', $sponsor_types)) {

                            PatientSponsor::create([
                                'patient_id' => $patient_id_no,
                                'opd_number' => $validated_data['opd_number'],
                                'sponsor_type_id' => $validated_data['sponsor_type_id'],
                                'sponsor_id' => $validated_data['sponsor_id'],
                                'member_no' => $validated_data['member_no'],
                                'start_date' => $validated_data['start_date'],
                                'end_date' => $validated_data['end_date'],
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
       
        $dob = Carbon::parse($birthdate); 
        $today = Carbon::now();
        $age_in_days = $dob->diffInDays($today);

            if ($age_in_days == 1) {
                return "1 DAY";
            } elseif ($age_in_days < 7) {
                return "$age_in_days DAYS";
            } elseif ($age_in_days < 14) {
                return "1 WEEK";
            } elseif ($age_in_days < 30) {
                $age_in_weeks = floor($age_in_days / 7);
                return "$age_in_weeks WEEKS";
            } elseif ($age_in_days == 30) {
                return "1 MONTH";
            } elseif ($age_in_days < 365) {
                $age_in_months = floor($age_in_days / 30);
                return "$age_in_months MONTHS";
            } elseif ($age_in_days == 365) {
                return "1 YEAR";
            } else {
                 $age_in_years = floor($age_in_days / 365);
                return "$age_in_years YEARS";
            }
    }


    public function show(Patient $patient)
    {
        $age_full = $this->get_age_full($patient->birth_date);

        $patients = DB::table('patient_info')
            ->where('patient_info.patient_id', $patient->patient_id)
            ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
            ->join('patient_nos', 'patient_nos.patient_id', '=', 'patient_info.patient_id')
            ->join('users', 'patient_info.user_id', '=', 'users.user_id')
            ->select('patient_info.patient_id', 'patient_nos.opd_number', 'patient_info.title', 'patient_info.fullname', 'gender.gender', 
                     'patient_info.birth_date', 'patient_info.email', 'patient_info.address', 'patient_info.contact_person', 
                     'patient_info.contact_relationship', 'patient_info.contact_telephone', 'patient_info.added_date', 
                     'patient_info.telephone', 'users.user_fullname', 'patient_info.gender_id', 'patient_info.death_status',
                     DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as patient_age'))
            ->orderBy('patient_info.added_date', 'asc') 
            ->first();

            
        $ages = Age::where('min_age', '<=', $patients->patient_age)
            ->where('max_age', '>=', $patients->patient_age)
            ->where('max_age', '>=', $patients->patient_age)
            ->first();

        $clinic_attendance = ServicePoints::select('service_point_id', 'service_points', 'gender_id', 'age_id')
                    ->where(function ($query) use ($patients) {
                        $query->where('gender_id', $patients->gender_id)
                            ->orWhere('gender_id', 1); // Assuming 1 is a default gender_id
                    })
                    ->where(function ($query) use ($ages) {
                        $query->where('age_id', $ages->age_id)
                            ->orWhere('age_id', 3); // Assuming 3 is a default age_id
                    })
                    ->where('archived', 'No')
                    ->where('is_active', 'Yes')
                    ->get();

        // $clinic_attendance = ServicePoints::select('service_point_id','service_points','gender_id', 'age_id')
        //     ->where('gender_id', $patients->gender_id)
        //     ->orWhere('gender_id', 1)
        //     ->where('age_id', $patient->age_id)
        //     ->orWhere('age_id', 3)
        //     ->where('archived', 'No')
        //     ->where('is_active', 'Yes')
        //     ->get();
    

        $todays_request = ServiceRequest::where('patient_attendance.archived','No')
            ->join('patient_sponsorship', 'patient_sponsorship.patient_id', '=', 'patient_attendance.patient_id')
            ->join('sponsor_type', 'patient_sponsorship.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.clinic_code')
            ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 'patient_attendance.pat_age', 
                    'service_attendance_type.attendance_type', 'sponsor_type.sponsor_type')
            ->where('patient_attendance.patient_id', $patient->patient_id)
            // ->whereDate('patient_attendance.attendance_date', Carbon::today()) 
            ->orderBy('patient_attendance.attendance_id', 'asc')
            ->get();

        // $request_episode = ServiceRequest::count();
        // $new_number = $request_episode + 1;
        // $episode = str_pad($new_number, 6, '0', STR_PAD_LEFT);
       
        // OLD ATTENDANCE REQUESTS
        $service_requests = ServiceRequest::where('patient_attendance.archived','No')
            ->join('patient_sponsorship', 'patient_sponsorship.patient_id', '=', 'patient_attendance.patient_id')
            ->join('sponsor_type', 'patient_sponsorship.sponsor_type_id', '=', 'sponsor_type.sponsor_type_id')
            ->join('service_attendance_type', 'service_attendance_type.attendance_type_id', '=', 'patient_attendance.clinic_code')
            ->select('patient_attendance.attendance_id', 'patient_attendance.opd_number', 'patient_attendance.attendance_date', 'patient_attendance.pat_age', 
                    'service_attendance_type.attendance_type', 'sponsor_type.sponsor_type')
            ->where('patient_attendance.patient_id', $patient->patient_id)
            ->orderBy('patient_attendance.attendance_id', 'asc')
            ->get();

        return view('patient.show', compact('patients', 'clinic_attendance', 'service_requests', 'age_full', 'todays_request'));
        
    }

    


    public function edit($patient_id)
    {  
        
        $title = Title::where('archived', 'No')->where('status', '=','Active')->get();
        $religion = Religion::where('archived', 'No')->where('status', '=','Active')->get();
        $gender = Gender::where('archived', 'No')->where('status', '=','Active')->where('usage', '=','1')->get();
        $region = Region::where('archived', 'No')->where('status', '=','Active')->get();
        $relation = Relation::where('archived', 'No')->where('status', '=','Active')->get();

        $patient_list = DB::table('patient_info')
            ->whereDate('patient_info.register_date', now())
            ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
            ->join('title', 'patient_info.title_id', '=', 'title.title_id')
            ->select('patient_info.patient_id', 'title.title', 'patient_info.firstname', 'patient_info.default_sponsor',  
                      'gender.gender',  'patient_info.birth_date', 'patient_info.added_date', 'patient_info.telephone', 
                       DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
            ->get();

        return view('patient.create', compact('title', 'religion', 'gender', 'region', 'relation', 'patient_list'));
    }

    public function update(Request $request, $pat_id)
    {
        $data = $request->validate([
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
        // $request->validate([
        //     'pat_number' => 'required',
        // ]);
        
        //  $searched_patient = Patient::where('pat_number', $request->input('pat_number')) ->first();
       
        // if($searched_patient)
        // {
        //     return 200;
        // }
        // $pat_to_be_deleted = Patient::find($request->pat_number);
        // $pat_to_be_deleted->delete();
        // return 201;

    }


    public function search(Request $request)
    {
            $search_term = $request->input('search_patient');

            // Step 1: Search in the Patient table
            $search_patient = Patient::query()
                ->where(function ($query) use ($search_term) {
                    $query->where('telephone', 'like', '%' . $search_term . '%');
                })
                ->get();

            // Step 2: If no results are found in the Patient table, search in the PatientSponsor table
            if ($search_patient->isEmpty()) {
                $search_patient = PatientSponsor::query()
                ->join('patient_info', 'patient_info.patient_id', '=', 'patient_sponsorship.patient_id')
                    ->where(function ($query) use ($search_term) {
                        $query->where('opd_number', 'like', '%' . $search_term . '%')
                            ->orWhere('member_no', 'like', '%' . $search_term . '%');
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


     public function attendance(Request $request, $patient_id)
     {
        $patients = DB::table('patient_info')
            ->where('patient_info.patient_id', $patient_id)
            ->join('gender', 'patient_info.gender_id', '=', 'gender.gender_id')
            ->join('title', 'patient_info.title_id', '=', 'title.title_id')
            ->select('patient_info.patient_id', 'title.title', 'patient_info.fullname',  'gender.gender', 
                'patient_info.birth_date', 'patient_info.email','patient_info.address',  'patient_info.added_date', 
                'patient_info.telephone', DB::raw('TIMESTAMPDIFF(YEAR, patient_info.birth_date, CURDATE()) as age'))
            ->orderBy('patient_info.added_date', 'asc') 
            ->first();

            // return view('patient.show', compact('patients'));
     }
     
    public function request_ccc(Request $request)
    {
        // API URL and authentication details
        $apiUrl = Http::get("https://elig.nhia.gov.gh:5000/api/hmis/genCCC");
        $apiKey = //"hp6658"; // API Key
        $secret = //"ncgxs3"; // Secret

        // Get the CardType and CardNo from the request (assuming form data is posted)
        $cardType = $request->input('cardType');
        $cardNo = $request->input('cardNo');

        // Prepare the form data
        $formData = [
            'CardType' => $cardType,
            'CardNo' => $cardNo
        ];

        // Send the POST request to the API
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'x-nhia-apikey' => $apiKey,  // API key header
                'x-nhia-apisecret' => $secret, // Secret key header
                'Authorization' => 'Basic ' . base64_encode("$apiKey:$secret") // Optional, if required
            ])->post($apiUrl, $formData);

            // Check if the response is JSON or plain text
            if ($response->header('Content-Type') === 'application/json') 
            {
                $result = $response->json(); // Parse as JSON
            } else 
            {
                $result = $response->body(); // Otherwise get plain text response
            }

            // Return the result to the frontend or view
            return response()->json([
                'success' => true,
                'result' => $result
            ]);

        } catch (\Exception $e) {
            // Handle errors and return the error message
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
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

    public function get_all_patient_attendance(Response $response, $patient_id)
    {
         $sponsor = DB::table('patient_sponsorship')
            ->where('patient_sponsorship.archived', 'No')
            ->where('patient_id', $patients->patient_id)
            ->join('sponsors', 'patient_sponsorship.sponsor_id', '=', 'sponsors.sponsor_id')
            // ->join('sponsor_type', 'patient_sponsorship.sponsor_id', '=', 'sponsors.sponsor_id')
            ->select('patient_sponsorship.member_no', 'patient_sponsorship.sponsor_id', 'sponsors.sponsor_name', 
                    'patient_sponsorship.start_date', 'patient_sponsorship.end_date', 
                    'patient_sponsorship.status', 'patient_sponsorship.priority', 'patient_sponsorship.is_active' )
            ->get();
    }

      
}
