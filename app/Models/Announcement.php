<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Announcement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'type',
        'is_active',
        'created_by',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'expires_at' => 'datetime',
    ];

    /**
     * The available announcement types.
     */
    const TYPE_GENERAL = 'general';
    const TYPE_WEATHER = 'weather';
    const TYPE_TRAIL = 'trail';
    const TYPE_EMERGENCY = 'emergency';

    /**
     * Get all available announcement types.
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_GENERAL,
            self::TYPE_WEATHER,
            self::TYPE_TRAIL,
            self::TYPE_EMERGENCY,
        ];
    }

    /**
     * Get the user who created the announcement.
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope a query to only include active announcements.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            });
    }

    /**
     * Scope a query to only include announcements of a specific type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to only include expired announcements.
     */
    public function scopeExpired($query)
    {
        return $query->where('expires_at', '<=', now());
    }

    /**
     * Check if the announcement is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Check if the announcement is active.
     */
    public function isActive(): bool
    {
        return $this->is_active && (!$this->expires_at || !$this->isExpired());
    }
}
