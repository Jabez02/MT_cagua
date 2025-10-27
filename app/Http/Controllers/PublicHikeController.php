<?php

namespace App\Http\Controllers;

use App\Models\Hike;
use Illuminate\Http\Request;

class PublicHikeController extends Controller
{
    /**
     * Display a listing of available hikes.
     */
    public function index()
    {
        $hikes = Hike::where('status', 'open')
                     ->where('date', '>=', now()->toDateString())
                     ->orderBy('date', 'asc')
                     ->orderBy('start_time', 'asc')
                     ->paginate(10);
        
        return view('hikes.index', compact('hikes'));
    }

    /**
     * Display the specified hike.
     */
    public function show(Hike $hike)
    {
        return view('hikes.show', compact('hike'));
    }
}