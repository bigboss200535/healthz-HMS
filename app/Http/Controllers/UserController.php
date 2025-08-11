<?php

namespace App\Http\Controllers;

use App\Models\LoginLog;
use App\Models\UserRole;
use App\Models\Gender;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    public function index()
    {
        $user = User::where('users.archived', 'No')->where('users.status', '=','Active')
            // ->rightJoin('user_roles', 'users.user_roles_id', '=', 'user_roles.user_roles_id')
            // ->select('users.*')
            ->select('user_id', 'username', 'user_fullname', 'telephone', 'telephone_verified', 'locked', 'expiry', 'mode', 'email', 'gender_id')
            // ->select('users.*','user_roles.*')
            ->orderBy('user_fullname', 'asc')->paginate(20);
            // ->get();

        $gender = Gender::where('archived', 'No')
            ->where('status', 'Active')
            ->where('usage', '1')
            ->get();
         
        $role = UserRole::where('archived', 'No')
            ->where('status', 'Active')
            ->where('usage', '0')
            ->orderBy('role_type', 'asc')
            ->get();

    // Use chunkById to process users in chunks
    // User::where('users.archived', 'No')
    //     ->where('users.status', '=', 'Active')
    //     ->rightJoin('user_roles', 'users.user_roles_id', '=', 'user_roles.user_roles_id')
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
            $validated_data = $request->validate([
                'u_user_name' => 'required|string|max:255',
                'first_name' => 'required|string|min:3|max:255',
                'other_name' => 'required|string|min:3|max:255',
                'u_pass_word' => 'required|string|min:3|max:255',
                'confirm_pass' => 'required|string|min:3|max:255',
                'u_email' => 'nullable|min:3|max:255',
                'title' => 'nullable|string|max:255',
                'u_telephone' => 'nullable|max:255',
                'gender' => 'nullable|string|max:255',
                'user_role' => 'required|string',
                'user_status' => 'required|string|min:3|max:255',
                'u_block' => 'nullable|min:3|max:100',
                'facility_id' => 'nullable|string|max:100',
            ]);

            $username_exist = User::where('username', $validated_data['u_user_name'])
                ->orWhere('telephone', $validated_data['u_telephone'])
                ->orWhere('email', $validated_data['u_email'])
                ->first();

            if ($username_exist) 
            {
                return response()->json([
                    'message' => 'User Already exist',
                    'code' =>'200'
                ], 200);
            }


            try {

                DB::beginTransaction();

                $new_user = User::create([
                    'user_id' => Str::uuid(),
                    'username' => $validated_data['u_user_name'],
                    'firstname' => $validated_data['first_name'],
                    'othername' => $validated_data['other_name'],
                    'password' => Hash::make($validated_data['u_pass_word']),
                    'oldpassword' => Hash::make($validated_data['confirm_pass']),
                    'telephone' => $validated_data['u_telephone'],
                    'email' => $validated_data['u_email'],
                    'title' => $validated_data['title'] ?? '',
                    'gender_id' => $validated_data['gender'],
                    'mode' => 'New',
                    'expiry' => 'No',
                    'added_id' => Auth::user()->user_id,
                    'facility_id' => $validated_data['facility_id'] ?? Auth::user()->facility_id,
                    'user_roles_id' => $validated_data['user_role'],
                    'status' => $validated_data['user_status'],
                    'expiry' => 'No',
                    'locked' => $validated_data['u_block'],
                ]);

                return response()->json([
                    'message' => 'User save successfully',
                    'code' =>'201'
                ], 201);

                DB::commit();

            } catch (\Exception $e) {
                DB::rollBack();
                // 
                return response()->json([
                    'message' => 'Error saving User details',
                    'error' => $e->getMessage()
                ], 500);
            }


            // return redirect()->route('users.index')->with('success', 'User created successfully');
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

    public function permissions($user_id)
    {

            $user = User::where('users.archived', 'No')
                ->where('users.user_id', $user_id)
                ->rightJoin('user_roles', 'user_roles.user_roles_id', '=', 'users.user_roles_id')
                ->first();

            $permissions = UserPermission::where('user_permissions.archived', 'No')
                ->where('user_permissions.user_id', $user_id)
                ->rightJoin('user_roles', 'user_roles.user_roles_id', '=', 'user_permissions.user_roles_id')
                ->rightJoin('permissions', 'permissions.permission_id', '=', 'user_permissions.permission_id')
                ->rightJoin('permission_role', 'permission_role.role_id', '=', 'user_permissions.role_id')
                ->select('user_permissions.user_permissions_id', 'user_permissions.user_id', 
                        'user_permissions.is_granted', 'user_permissions.can_read', 'user_permissions.can_create', 
                        'user_permissions.can_delete', 'user_permissions.can_update', 'user_permissions.added_date', 
                        'permissions.permission_name', 'permission_role.role_name')
                        ->orderBy('permission_role.role_name', 'asc')
                ->get();
    
        return view('users.permissions.index', compact('user', 'permissions'));
    }


    private function get_user_by_id()
    {
        return $user = User::where('user_id', Auth::user()->user_id)
            ->first();
    }
}
