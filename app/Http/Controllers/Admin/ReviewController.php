<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    /**
     * Display a listing of all reviews.
     */
    public function index(Request $request)
    {
        $query = Review::with(['user', 'moderator', 'booking']);

        // Apply filters
        switch ($request->filter) {
            case 'pending':
                $query->where('is_verified', false);
                break;
            case 'verified':
                $query->where('is_verified', true);
                break;
            case 'hidden':
                $query->where('is_public', false);
                break;
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Display the specified review.
     */
    public function show(Review $review)
    {
        $review->load(['user', 'moderator', 'booking']);
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Verify and publish a review.
     */
    public function verify(Review $review)
    {
        $review->update([
            'is_verified' => true,
            'is_public' => true,
            'moderated_by' => Auth::id(),
            'moderated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Review has been verified and published.');
    }

    /**
     * Hide a review from public view.
     */
    public function hide(Review $review)
    {
        $review->update([
            'is_public' => false,
            'moderated_by' => Auth::id(),
            'moderated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Review has been hidden from public view.');
    }

    /**
     * Make a review public.
     */
    public function publish(Review $review)
    {
        $review->update([
            'is_public' => true,
            'moderated_by' => Auth::id(),
            'moderated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Review has been made public.');
    }

    /**
     * Reject a review.
     */
    public function reject(Request $request, Review $review)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $review->update([
            'status' => 'rejected',
            'is_verified' => false,
            'is_public' => false,
            'rejection_reason' => $request->rejection_reason,
            'moderated_by' => Auth::id(),
            'moderated_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Review has been rejected.');
    }

    /**
     * Remove the specified review from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Review has been deleted successfully.');
    }
}
