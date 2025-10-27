<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'status',
        'user_id',
        'admin_id',
        'last_message_at',
        'participants'
    ];

    protected $casts = [
        'last_message_at' => 'datetime',
        'participants' => 'array'
    ];

    // Conversation types
    const TYPE_SUPPORT = 'support';
    const TYPE_GENERAL = 'general';
    const TYPE_BOOKING = 'booking';

    // Conversation statuses
    const STATUS_ACTIVE = 'active';
    const STATUS_CLOSED = 'closed';
    const STATUS_ARCHIVED = 'archived';

    /**
     * Get the user that owns the conversation
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the admin assigned to the conversation
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    /**
     * Get all messages in this conversation
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class)->orderBy('created_at', 'asc');
    }

    /**
     * Get the latest message in the conversation
     */
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }

    /**
     * Get unread messages count for a specific user
     */
    public function getUnreadCountForUser($userId)
    {
        return $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('delivery_status', '!=', 'read')
            ->count();
    }

    /**
     * Mark all messages as read for a specific user
     */
    public function markAsReadForUser($userId)
    {
        $this->messages()
            ->where('sender_id', '!=', $userId)
            ->where('delivery_status', '!=', 'read')
            ->update([
                'delivery_status' => 'read',
                'read_at' => now()
            ]);
    }

    /**
     * Scope for active conversations
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Scope for conversations by user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for conversations assigned to admin
     */
    public function scopeForAdmin($query, $adminId)
    {
        // Allow all admins to see all support conversations
        // Or only show conversations specifically assigned to this admin
        return $query->where(function($q) use ($adminId) {
            $q->where('admin_id', $adminId)
              ->orWhere('admin_id', null); // Show unassigned conversations
        });
    }
}
