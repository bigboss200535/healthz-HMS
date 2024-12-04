<?php

namespace App\Http\Controllers;

use App\Models\ConsultingRoom;
use App\Models\Stores;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsultationController extends Controller
{
    
    public function index($user_id)
    {
          $con_room = ConsultingRoom::where('Archived', 'No')->get();
          $store = Stores::where('archived', 'No')->where('is_pharmacy', '=', 'Yes')->get();
          // $outcome = 

          if (Auth::user()->role_id==='R10'|| Auth::user()->role_id==='R11')
          {
            $user = User::where(Auth::user()->user_id)->get(); //log in doctor
          }
          else
          {
            $user = User::where(Auth::user()->role_id)->get();// all doctors
          }

          return view('consultation.index', compact('users','con_room'));  
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
    
}
