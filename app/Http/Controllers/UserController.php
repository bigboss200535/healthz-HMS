<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\UserRole;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('users.archived', 'No')->where('users.status', '=','Active')
            ->rightJoin('user_roles', 'users.role_id', '=', 'user_roles.role_id')
            ->select('users.*','user_roles.*')
            ->orderBy('users.user_fullname', 'asc')
            ->get();

        $gender = Gender::where('archived', 'No')
            ->where('status', 'Active')
            ->get();
         
        $role = UserRole::where('archived', 'No')
            ->where('status', 'Active')
            ->orderBy('role_name', 'asc')
            ->get();

    // Use chunkById to process users in chunks
    // User::where('users.archived', 'No')
    //     ->where('users.status', '=', 'Active')
    //     ->rightJoin('user_roles', 'users.role_id', '=', 'user_roles.role_id')
    //     ->select('users.*', 'user_roles.*')
    //     ->chunk(20, function ($userChunk) use (&$user) {
    //         foreach ($userChunk as $users) {
    //             $user[] = $users; // This stores each user record (you can process them as needed)
    //         }
    //     });

         return view('users.index', compact('user', 'gender', 'role'));
    }

    public function create()
    {
        return view('profile.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'username' => 'required|string|min:1',
        ]);

         $product = User::create([
            'user_id' => $request->product_name,
            'username' => $request->category_id,
        ]); 
    }

    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('username')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();
        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    public function destroy(Request $request, $id)
    {

        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current-password'],
        // ]);

        // $user = $request->user();

        // // Auth::logout();
        // $user->delete();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // return Redirect::to('/');
    }

    public function getuserlog()
    {
        $userlogs = LoginLog::where('archived', 'No')
        ->where('user_logs.status', '=','Active')
        // ->rightJoin('user_roles', 'users.role_id', '=', 'user_roles.role_id')
        ->select('logname','user_ip', 'user_pc', 'session_id', 'user_id',  'login_date', 'logout_date', 'login_time', 
        'logout_time')
        ->get();

        // $user = User::where('user_logs.archived', 'No')
        // ->where('users.status', '=','Active')
        // ->rightJoin('user_roles', 'users.role_id', '=', 'user_roles.role_id')
        // ->select('users.*','user_roles.*')
        // ->get();
    }
}
