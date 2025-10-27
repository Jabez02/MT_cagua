<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'transaction_id',
        'amount',
        'payment_method',
        'status',
        'payment_data',
        'verified_at',
        'receipt_url',
        'refunded',
        'refund_id',
        'refunded_at'
    ];

    protected $casts = [
        'payment_data' => 'array',
        'verified_at' => 'datetime',
        'refunded_at' => 'datetime',
        'refunded' => 'boolean'
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method', 'code');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->through('booking');
    }

    // Alternative approach using hasOneThrough
    public function getUserAttribute()
    {
        return $this->booking?->user;
    }
}