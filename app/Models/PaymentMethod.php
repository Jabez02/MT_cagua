<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'instructions',
        'processing_fee_percentage',
        'processing_fee_fixed',
        'min_amount',
        'max_amount',
        'currencies',
        'is_active',
        'priority',
        'configuration',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'currencies' => 'array',
        'configuration' => 'encrypted:array',
        'processing_fee_percentage' => 'decimal:2',
        'processing_fee_fixed' => 'decimal:2',
        'min_amount' => 'decimal:2',
        'max_amount' => 'decimal:2',
    ];

    /**
     * Get the payments using this method.
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'payment_method', 'code');
    }

    /**
     * Calculate the processing fee for a given amount.
     */
    public function calculateProcessingFee($amount)
    {
        $percentageFee = $amount * ($this->processing_fee_percentage / 100);
        return $percentageFee + $this->processing_fee_fixed;
    }

    /**
     * Check if the payment method is available for a given amount.
     */
    public function isAvailableForAmount($amount)
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->min_amount && $amount < $this->min_amount) {
            return false;
        }

        if ($this->max_amount && $amount > $this->max_amount) {
            return false;
        }

        return true;
    }

    /**
     * Scope a query to only include active payment methods.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to order by priority.
     */
    public function scopeByPriority($query)
    {
        return $query->orderBy('priority');
    }
}