<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hikes = Hike::orderBy('date', 'asc')
                     ->orderBy('start_time', 'asc')
                     ->paginate(10);
        
        return view('admin.hikes.index', compact('hikes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hikes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required|in:05:30,06:00,07:00,10:00,10:30,11:00,11:30,12:00,12:30,13:00',
            'trail' => 'required|in:Sta. Clara Trail (Back-Trail Only),Alternative Trail',
            'capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'difficulty' => 'required|in:easy,moderate,hard',
            'status' => 'required|in:open,full,closed',
            'notes' => 'nullable|string',
        ]);

        $hike = Hike::create($validated);

        return redirect()
            ->route('admin.hikes.index')
            ->with('success', 'Hike schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hike $hike)
    {
        $hike->load(['bookings.user']);
        return view('admin.hikes.show', compact('hike'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hike $hike)
    {
        return view('admin.hikes.edit', compact('hike'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hike $hike)
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'trail' => 'required|in:Sta. Clara Trail,Alternative Trail',
            'capacity' => 'required|integer|min:' . $hike->current_bookings,
            'price' => 'required|numeric|min:0',
            'difficulty' => 'required|in:easy,moderate,hard',
            'status' => 'required|in:open,full,closed',
            'notes' => 'nullable|string',
        ]);

        // Check if capacity is being reduced below current bookings
        if ($validated['capacity'] < $hike->current_bookings) {
            return back()
                ->withErrors(['capacity' => 'Cannot reduce capacity below current number of bookings.'])
                ->withInput();
        }

        $hike->update($validated);

        return redirect()
            ->route('admin.hikes.index')
            ->with('success', 'Hike schedule updated successfully.');
    }

    /**
     * Print the specified hike details.
     */
    public function print(Hike $hike)
    {
        $hike->load(['bookings.user']);
        return view('admin.hikes.print', compact('hike'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hike $hike)
    {
        // Check if there are any active bookings
        if ($hike->current_bookings > 0) {
            return back()->with('error', 'Cannot delete schedule with active bookings.');
        }

        $hike->delete();

        return redirect()
            ->route('admin.hikes.index')
            ->with('success', 'Hike schedule deleted successfully.');
    }
}
