<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showLoginForm() {
        return view('signinlan');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            $role = strtolower($user->role);

            if ($role === 'participant') {
                return redirect()->route('aamainhome');
            }

            if ($role === 'organizer_active') {
                return redirect()->route('organizer.home');
            }

            Auth::logout();
            return redirect()->route('signinlan')
                ->withErrors(['email' => 'Invalid role access.']);
        }

        return back()->withErrors([
            'email' => 'Incorrect email or password.',
        ]);
    }

    public function resetpass(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Password reset successful'
            ]);
        }

        return redirect()->route('signinlan')->with('success', 'Password has been reset. Please login with your new password.');
    }

    public function showChangeAccountForm() {
        return view('switchaccount');
    }

    public function changeAccount(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();
            session(['last_login_email' => $request->email]);

            $user = Auth::user();
            $role = strtolower($user->role);

            if ($role === 'participant') {
                return redirect()->route('aamainhome');
            }

            if (in_array($role, ['organizer', 'organizer_active'])) {
                return redirect()->route('organizer.home');
            }
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!$user) {
            return back()->withErrors(['error' => 'User not found']);
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->setRememberToken(Str::random(60));
        $user->save();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('signinlan')->with('success', 'Password successfully updated. Please login again.');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/landinghome');
    }

}
