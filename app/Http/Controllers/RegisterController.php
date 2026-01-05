<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name'=> 'required|string|max:100',
            'email'=> 'required|string|unique:users,email',
            'password'=> 'required|string|min:6|confirmed',
        ]);   
      
    $user = User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password),
    ]);

    Auth::login($user);

    return redirect()->route('aamainhome')->with('success', 'Account created successfully!');
    }
}
