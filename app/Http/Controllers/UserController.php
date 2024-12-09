<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::where('users.archived', 'No')->where('users.status', '=','Active')
        ->rightJoin('user_roles', 'users.role_id', '=', 'user_roles.role_id')
        ->select('users.*','user_roles.*')
        ->get();
        return view('users.index', compact('user'));
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
}
