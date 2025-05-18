<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    // @desc update profile info
    // @route PUT /profile

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // validate data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'avatar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        // Get user name and email 
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // delete old avatar if exists
            if ($user->avatar) {

                Storage::disk('public')->delete($user->avatar);
            }

            // store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            \Log::info('New avatar uploaded, public url: ', [
                'url' => asset('storage/' . $avatarPath),
            ]);
        }

        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile info updated!');
    }
}
