<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    
     public function index(Request $request): View
     {
        $user = User::where('users.archived', 'No')
            ->join('gender', 'gender.gender_id', '=', 'users.gender_id')
            ->join('user_roles', 'user_roles.user_roles_id', '=', 'users.user_roles_id')
            ->where('users.status', '=', 'Active')
            ->where('users.user_id', Auth::user()->user_id)
            ->first();

        $user_logs = User::where('users.archived', 'No')->where('users.user_id', Auth::user()->user_id)->get();
            
        return view('profile.index', compact('user', 'user_logs'));
     }


    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        // $request->validateWithBag('userDeletion', [
        //     'password' => ['required', 'current-password'],
        // ]);

        // $user = $request->user();

        // Auth::logout();
        // $user->delete();
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // return Redirect::to('/');
    }

    // public function login()
    // {
    //     return view('login');
    // }
    public function change_password(Request $request)
    {
        $request->validate([
           'old_password' => ['required', 'string', 'max:100'],
           'new_password' => ['required', 'string', 'max:100', 'min:8', 'different:old_password'],
           'confirm_password' => ['required', 'string', 'same:new_password', 'max:100', 'min:8'],
        ]);

        $user = auth()->user();

        // Verify old password matches
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'The current password is incorrect']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password),
            'updated_by' => Auth::user()->user_id,
        ]);

        // return response()->json([
        //             'success' => true,
        //             'code' => 200,
        //             // 'result' => ''
        //         ]);
            if ($request->ajax()) {
                    return response()->json(['message' => 'Password updated successfully'], 200);
                }

                return back()->with('status', 'Password updated successfully');
    }
   
}
