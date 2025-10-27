<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Porter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_number',
        'address',
        'status',
        'max_weight_capacity',
        'total_hikes',
    ];

    protected $casts = [
        'max_weight_capacity' => 'integer',
        'total_hikes' => 'integer',
    ];

    // Status constants
    const STATUS_AVAILABLE = 'available';
    const STATUS_ASSIGNED = 'assigned';
    const STATUS_UNAVAILABLE = 'unavailable';

    // Relationships
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', [self::STATUS_AVAILABLE, self::STATUS_ASSIGNED]);
    }

    public function scopeByCapacity($query, $minCapacity)
    {
        return $query->where('max_weight_capacity', '>=', $minCapacity);
    }

    // Helper methods
    public function isAvailable()
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    public function isAssigned()
    {
        return $this->status === self::STATUS_ASSIGNED;
    }

    public function incrementHikes()
    {
        $this->increment('total_hikes');
    }

    public function getStatusBadgeClass()
    {
        return match($this->status) {
            self::STATUS_AVAILABLE => 'badge-success',
            self::STATUS_ASSIGNED => 'badge-warning',
            self::STATUS_UNAVAILABLE => 'badge-danger',
            default => 'badge-secondary'
        };
    }

    public function getStatusLabel()
    {
        return match($this->status) {
            self::STATUS_AVAILABLE => 'Available',
            self::STATUS_ASSIGNED => 'Assigned',
            self::STATUS_UNAVAILABLE => 'Unavailable',
            default => 'Unknown'
        };
    }

    public function getCapacityDisplayAttribute()
    {
        return $this->max_weight_capacity . ' kg';
    }

    public function getCapacityDisplay()
    {
        return $this->max_weight_capacity . ' kg';
    }

    public function canCarry($weight)
    {
        return $this->max_weight_capacity >= $weight;
    }
}
