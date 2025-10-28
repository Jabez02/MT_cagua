<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trek_date',
        'start_time',
        'trail',
        'guide_id',
        'porter_id',
        'foreign_tourists',
        'local_tourists',
        'foreign_nationalities',
        'length_of_stay',
        'transportation',
        'tricycle_rental',
        'tricycle_fee',
        'health_issues',
        'tourist_fee',
        'guide_fee',
        'porter_fee',
        'processing_fee',
        'total_amount',
        'down_payment',
        'payment_method',
        'payment_reference',
        'meeting_place',
        'terms_agreed',
        'special_requests',
        'status',
        'approved_at',
        'approved_by',
        'cancellation_reason',
        'payment_verified_at',
        'payment_verified_by',
        'verification_notes',
        'payment_rejected_at',
        'payment_rejected_by',
        'rejection_reason',
        'rejection_notes'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'payment_verified_at' => 'datetime',
        'payment_rejected_at' => 'datetime',
        'trek_date' => 'date',
        'start_time' => 'datetime:H:i',
        'health_issues' => 'array',
        'foreign_nationalities' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    public function guide(): BelongsTo
    {
        return $this->belongsTo(Guide::class);
    }

    public function porter(): BelongsTo
    {
        return $this->belongsTo(Porter::class);
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function paymentVerifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_verified_by');
    }

    public function paymentRejecter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'payment_rejected_by');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    /**
     * Convert length_of_stay enum value to numeric days for calculations.
     * 
     * @return int
     */
    public function getLengthOfStayInDays(): int
    {
        return match ($this->length_of_stay) {
            'day_hike' => 1,
            'overnight' => 2,
            'other' => 1, // Default to 1 day for 'other' type
            default => 1, // Fallback to 1 day
        };
    }
}
