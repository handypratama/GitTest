<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register', [
            "pageTitle" => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $user = new User();

        Validator::make($request->all(), [
            'name' => ['required', 'unique:users', 'regex:/^[a-zA-Z\s]*$/'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'password' => ['required', 'min:5', 'max:20'],
            'address' => ['required', 'min:5', 'max:95'],
            'gender' => ['required']
        ])->validate();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->address = $request->address;
        $user->gender = $request->gender;

        $user->password = Hash::make($user->password);

        $user->save();

        return redirect('/login')->with('registrationMessage', 'Registration successful!');
    }
}
