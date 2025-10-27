<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Porter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PorterController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $page = $request->get('page', 1);
        $perPage = 10;
        
        $porters = Porter::orderBy('name')->paginate($perPage, ['*'], 'page', $page);
        
        return view('admin.porters.index', compact('porters'));
    }

    public function create()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.porters.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'status' => ['required', 'in:available,assigned,unavailable'],
            'max_weight_capacity' => ['required', 'integer', 'min:1', 'max:200'],
        ]);

        Porter::create($validated);

        return redirect()
            ->route('admin.porters.index')
            ->with('success', 'Porter created successfully.');
    }

    public function show(Porter $porter)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $porter->load(['bookings' => function($query) {
            $query->with(['hike', 'user'])->latest()->take(10);
        }]);

        return view('admin.porters.show', compact('porter'));
    }

    public function edit(Porter $porter)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.porters.edit', compact('porter'));
    }

    public function update(Request $request, Porter $porter)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'status' => ['required', 'in:available,assigned,unavailable'],
            'max_weight_capacity' => ['required', 'integer', 'min:1', 'max:200'],
        ]);

        $porter->update($validated);

        return redirect()
            ->route('admin.porters.show', $porter)
            ->with('success', 'Porter updated successfully.');
    }

    public function destroy(Porter $porter)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Check if porter has any bookings
        if ($porter->bookings()->count() > 0) {
            return back()->with('error', 'Cannot delete porter with existing bookings.');
        }

        $porter->delete();

        return redirect()
            ->route('admin.porters.index')
            ->with('success', 'Porter deleted successfully.');
    }

    public function toggleStatus(Porter $porter)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $newStatus = $porter->status === Porter::STATUS_AVAILABLE 
            ? Porter::STATUS_UNAVAILABLE 
            : Porter::STATUS_AVAILABLE;

        $porter->update(['status' => $newStatus]);

        return back()->with('success', 'Porter status updated successfully.');
    }
}