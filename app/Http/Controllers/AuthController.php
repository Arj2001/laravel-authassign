<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'cpassword' => 'required|same:password',
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }

    public function login(Request $request)
    {
        $cred = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if(Auth::attempt($cred)){
            return redirect('/posts');
        }else{
            return back()->withErrors([

                'email' => 'The provided credentials do not match our records.',

            ])->onlyInput('email');
        }


    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
    public function userProfile()
    {
        $user = Auth::user();
        return view('user', compact('user'));
    }
    public function editProfile()
    {
        $user = Auth::user();
        return view('user', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('user.profile')
                         ->with('success', 'Profile updated successfully.');
    }
}
