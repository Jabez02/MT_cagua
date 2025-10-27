<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ManageUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('usertype', 'user');

        // Apply filters
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nationality', 'like', "%{$search}%");
            });
        }

        // Apply sorting
        $sortField = $request->get('sort', 'created_at');
        $sortDirection = $request->get('direction', 'desc');
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(10)->withQueryString();
        
        return view('admin.manage-user.index', compact('users'));
    }

    public function show(User $user)
    {
        if ($user->usertype !== 'user') {
            return back()->with('error', 'Cannot view admin accounts.');
        }

        return view('admin.manage-user.show', compact('user'));
    }

    public function approve(User $user)
    {
        if ($user->usertype !== 'user') {
            return back()->with('error', 'Cannot modify admin accounts.');
        }

        $user->update([
            'status' => 'approved',
            'approved_at' => Carbon::now()
        ]);

        // Send notification to user
        $user->notify(new UserStatusChanged($user, 'approved'));

        return back()->with('success', 'User has been approved successfully.');
    }

    public function reject(User $user)
    {
        if ($user->usertype !== 'user') {
            return back()->with('error', 'Cannot modify admin accounts.');
        }

        $user->update([
            'status' => 'rejected',
            'approved_at' => null
        ]);

        // Send notification to user
        $user->notify(new UserStatusChanged($user, 'rejected'));

        return back()->with('success', 'User has been rejected successfully.');
    }

    public function pending(User $user)
    {
        if ($user->usertype !== 'user') {
            return back()->with('error', 'Cannot modify admin accounts.');
        }

        $user->update([
            'status' => 'pending',
            'approved_at' => null
        ]);

        // Send notification to user
        $user->notify(new UserStatusChanged($user, 'pending'));

        return back()->with('success', 'User has been set to pending status.');
    }

    public function destroy(User $user)
    {
        if ($user->usertype !== 'user') {
            return back()->with('error', 'Cannot delete admin accounts.');
        }

        // Check if user has any active bookings
        if ($user->bookings()->whereIn('status', ['pending', 'approved'])->exists()) {
            return back()->with('error', 'Cannot delete user with active bookings. Please cancel or complete their bookings first.');
        }

        $userName = $user->name;
        $user->delete();

        return back()->with('success', "User {$userName} has been deleted successfully.");
    }
}
