<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager extends Controller
{
    function login() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    function loginPost(Request $request){
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with("error", "Invalid credentials");
    }

    function registration(){
        return view('registration');
    }

    function registrationPost(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username', 
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'photo' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('uploads/users', $filename, 'public');
            $data['photo'] = $filename;
        }

        $user = User::create($data);

        if (!$user) {
            return redirect()-back()->with('error', 'Failed to add user');
        }
        return redirect()->route('login')->with('success', 'Registration successful');
    }

    function logout(){
        session()->flush();
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
