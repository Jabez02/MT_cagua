<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_number',
        'address',
        'status',
        'specializations',
        'total_treks',
    ];

    protected $casts = [
        'total_treks' => 'integer',
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

    // Accessors
    public function getSpecializationsArrayAttribute()
    {
        return $this->specializations ? explode(',', $this->specializations) : [];
    }

    // Mutators
    public function setSpecializationsAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['specializations'] = implode(',', array_filter($value));
        } else {
            $this->attributes['specializations'] = $value;
        }
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

    /**
     * Check if the guide is available on a specific date
     * 
     * @param string $date
     * @return bool
     */
    public function isAvailableOnDate($date)
    {
        // Check if guide has any active bookings on this date
        return !$this->bookings()
            ->whereDate('trek_date', $date)
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->exists();
    }

    /**
     * Get all bookings for a specific date
     * 
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBookingsForDate($date)
    {
        return $this->bookings()
            ->whereDate('trek_date', $date)
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->with('user')
            ->get();
    }

    /**
     * Scope to get guides available on a specific date
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailableOnDate($query, $date)
    {
        return $query->whereDoesntHave('bookings', function ($q) use ($date) {
            $q->whereDate('trek_date', $date)
              ->whereNotIn('status', ['cancelled', 'completed']);
        });
    }

    /**
     * Get availability status for a date range
     * 
     * @param string $startDate
     * @param string $endDate
     * @return array
     */
    public function getAvailabilityForDateRange($startDate, $endDate)
    {
        $bookings = $this->bookings()
            ->whereBetween('trek_date', [$startDate, $endDate])
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->pluck('trek_date')
            ->toArray();

        $availability = [];
        $current = new \DateTime($startDate);
        $end = new \DateTime($endDate);

        while ($current <= $end) {
            $dateStr = $current->format('Y-m-d');
            $availability[$dateStr] = !in_array($dateStr, $bookings);
            $current->modify('+1 day');
        }

        return $availability;
    }

    public function incrementTreks()
    {
        $this->increment('total_treks');
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
}
