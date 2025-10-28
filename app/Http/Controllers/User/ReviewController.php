<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
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
            ->with(['booking'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('user.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new review.
     */
    public function create(Booking $booking)
    {
        // Check if user has completed this booking
        if ($booking->user_id !== Auth::id() || $booking->status !== 'completed') {
            return redirect()->route('user.bookings.index')
                ->with('error', 'You can only review completed bookings.');
        }

        // Check if user has already reviewed this booking
        $hasReviewed = Review::where('user_id', Auth::id())
            ->where('booking_id', $booking->id)
            ->exists();

        if ($hasReviewed) {
            return redirect()->route('user.reviews.index')
                ->with('error', 'You have already reviewed this booking.');
        }

        return view('user.reviews.create', compact('booking'));
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['required', 'string', 'max:1000'],
            'images' => ['nullable', 'array', 'max:5'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePaths = [];
        
        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('reviews', 'public');
                $imagePaths[] = $path;
            }
        }

        $review = Review::create([
            'user_id' => Auth::id(),
            'booking_id' => $booking->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'images' => $imagePaths,
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

        $review->load(['booking', 'moderator']);
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
            'comment' => ['required', 'string', 'max:1000'],
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
