<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Hike;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the user's reviews.
     */
    public function index()
    {
        $reviews = Review::where('user_id', Auth::id())
            ->with(['hike'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(Hike $hike)
    {
        // Check if user has completed this hike
        $hasCompletedHike = Booking::where('user_id', Auth::id())
            ->where('hike_id', $hike->id)
            ->where('status', 'completed')
            ->exists();

        if (!$hasCompletedHike) {
            return redirect()->route('user.bookings.index')
                ->with('error', 'You can only review hikes you have completed.');
        }

        // Check if user has already reviewed this hike
        $hasReviewed = Review::where('user_id', Auth::id())
            ->where('hike_id', $hike->id)
            ->exists();

        if ($hasReviewed) {
            return redirect()->route('user.reviews.index')
                ->with('error', 'You have already reviewed this hike.');
        }

        return view('user.reviews.create', compact('hike'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Hike $hike)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $review = Review::create([
            'user_id' => Auth::id(),
            'hike_id' => $hike->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_verified' => false,
            'is_public' => true,
        ]);

        return redirect()->route('user.reviews.show', $review)
            ->with('success', 'Review submitted successfully. It will be visible after moderation.');
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $review->load(['hike', 'moderator']);
        return view('user.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified review.
     */
    public function edit(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($review->is_verified) {
            return redirect()->route('user.reviews.show', $review)
                ->with('error', 'Cannot edit a verified review.');
        }

        return view('user.reviews.edit', compact('review'));
    }

    /**
     * Update the specified review in storage.
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($review->is_verified) {
            return redirect()->route('user.reviews.show', $review)
                ->with('error', 'Cannot edit a verified review.');
        }

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'is_verified' => false,
        ]);

        return redirect()->route('user.reviews.show', $review)
            ->with('success', 'Review updated successfully. It will be reviewed again for moderation.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($review->is_verified) {
            return redirect()->route('user.reviews.show', $review)
                ->with('error', 'Cannot delete a verified review.');
        }

        $review->delete();

        return redirect()->route('user.reviews.index')
            ->with('success', 'Review deleted successfully.');
    }
}
