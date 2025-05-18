<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // @desc update profile info
    // @route PUT /profile

    public function update(Request $request): RedirectResponse
    {
        $user = Auth::user();

        // validate data
        $validateData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
        ]);

        $user->update($validateData);

        return redirect()->route('dashboard')->with('success', 'Profile info updated!');
    }
}
