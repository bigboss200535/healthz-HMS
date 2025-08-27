<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientAttendance;
use App\Models\PatientAppointments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        // role specific data
        // $user_role = Auth::user()->user_roles_id;
        // if($user_role=== '')
        // {

        // }elseif ($user_role==='')
        // {

        // }else{
        //     // admin 
        // }

        $today = date('Y-m-d');
        
        $out_patient = PatientAttendance::where('archived', 'No')->where('attendance_date', $today)->count();

        $in_patient = DB::table('patient_admissions')->where('archived', 'No')->count();
        
        // general appointments
        $appointments = PatientAppointments::where('archived', 'No')->count();
        
        //today's appointments 
        $today_appointments = PatientAppointments::with('patients')
            ->whereDate('appointment_date', now()->toDateString())
            ->orderBy('appointment_date')
            ->take(5)
            ->get();

        // recent patient
        $recent_patient = Patient::where('archived', 'No')->take(5)->get();
       
        // greetings
        $current_hour = Carbon::now()->format('H');

            if($current_hour>=0 && $current_hour<=12)
            {
                $greeting = '<img src="' . asset('img/icons/sunny.png') . '" alt="greetings" class="rounded" style="width: 35px;" />' . ' Good Morning';
            }
            elseif ($current_hour>=12 && $current_hour<=18)
            {
                $greeting = '<img src="' . asset('img/icons/afternoon.png') . '" alt="greetings" class="rounded" style="width: 35px;" />' . ' Good Afternoon';
            }
            elseif ($current_hour>=18 && $current_hour<=24) 
            {
                $greeting = '<img src="' . asset('img/icons/night.png') . '" alt="greetings" class="rounded" style="width: 35px;" />' . ' Good Evening';
            }
            else{
                $greeting = 'Hello!';
            }

        return view('dashboard', compact('greeting', 'in_patient', 'out_patient', 'appointments', 'today_appointments'));
    }



    
}
