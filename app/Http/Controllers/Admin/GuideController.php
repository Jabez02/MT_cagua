<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuideController extends Controller
{
    public function index()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $guides = Guide::orderBy('name')->paginate(10);
        
        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.guides.create');
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
            'specializations' => ['nullable', 'string', 'max:1000'],
        ]);

        Guide::create($validated);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Guide created successfully.');
    }

    public function show(Guide $guide)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $guide->load(['bookings' => function($query) {
            $query->with(['user'])->latest()->take(10);
        }]);

        return view('admin.guides.show', compact('guide'));
    }

    public function edit(Guide $guide)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.guides.edit', compact('guide'));
    }

    public function update(Request $request, Guide $guide)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:500'],
            'status' => ['required', 'in:available,assigned,unavailable'],
            'specializations' => ['nullable', 'string', 'max:1000'],
        ]);

        $guide->update($validated);

        return redirect()
            ->route('admin.guides.show', $guide)
            ->with('success', 'Guide updated successfully.');
    }

    public function destroy(Guide $guide)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Check if guide has any bookings
        if ($guide->bookings()->count() > 0) {
            return back()->with('error', 'Cannot delete guide with existing bookings.');
        }

        $guide->delete();

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Guide deleted successfully.');
    }

    public function toggleStatus(Guide $guide)
    {
        if (auth()->user()->usertype !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $newStatus = $guide->status === Guide::STATUS_AVAILABLE 
            ? Guide::STATUS_UNAVAILABLE 
            : Guide::STATUS_AVAILABLE;

        $guide->update(['status' => $newStatus]);

        return back()->with('success', 'Guide status updated successfully.');
    }
}