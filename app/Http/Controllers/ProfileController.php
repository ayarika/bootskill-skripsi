<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller {

    public function edit(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_picture')) {

            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $user->profile_picture = $request
                ->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        if ($user->email !== $data['email']) {
            $data['email_verified_at'] = null;
        }

        $user->update($data);

        Auth::setUser($user->fresh());

        return back()->with('success', 'Profile updated successfully!');
    }

    public function switchRole(Request $request): RedirectResponse {
        $user = Auth::user();

        if ($user->role === 'participant') {
            $user->role = 'organizer_active';
            $redirectRoute = 'organizer.home';
            $successMsg = 'Switched to Organizer';
        } else {
            $user->role = 'participant';
            $redirectRoute = 'aamainhome';
            $successMsg = 'Switched to Participant';
        }

        $user->save();
        Auth::setUser($user->fresh());
        
        return redirect()->route($redirectRoute)->with('success', $successMsg);
    }

    public function updateNotifications(Request $request): RedirectResponse {
        $user = $request->user();

        $user->email_notification = $request->has('email_notification');
        $user->inapp_notification = $request->has('inapp_notification');
        $user->bootcamp_updates = $request->has('bootcamp_updates');

        $user->save();

        return redirect()->back()
            ->with('success', 'Notification preferences updated successfully.')
            ->with('active_tab', 'notification');
    }

    public function destroy(Request $request): RedirectResponse {

        $user = $request->user();

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showSettings(): View {
        return view('settings', [
            'user' => \App\Models\User::find(Auth::id()),
        ]);
    }
}