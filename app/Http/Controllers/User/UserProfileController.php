<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Booking;
use App\Models\Achievement;

class UserProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $achievements = Achievement::where('user_id', $user->id)
            ->orderBy('awarded_at', 'desc')
            ->get();

        return view('user.profile.show', compact('user', 'bookings', 'achievements'));
    }

    public function edit()
    {
        return view('user.profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'contact_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:255'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_number' => ['required', 'string', 'max:20'],
            'nationality' => ['required', 'string', 'max:100'],
        ]);

        $user->update($validated);

        return redirect()->route('user.profile.show')->with('status', 'profile-updated');
    }
}
