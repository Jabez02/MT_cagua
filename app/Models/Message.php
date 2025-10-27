<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'conversation_id',
        'subject',
        'message',
        'message_type',
        'sender_type',
        'sender_id',
        'delivery_status',
        'delivered_at',
        'reactions',
        'reply_to_message_id',
        'reply',
        'replied_by',
        'status',
        'is_important',
        'is_archived',
        'read_at',
        'replied_at',
        'archived_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
        'archived_at' => 'datetime',
        'delivered_at' => 'datetime',
        'is_important' => 'boolean',
        'is_archived' => 'boolean',
        'reactions' => 'array',
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_REPLIED = 'replied';
    const STATUS_CLOSED = 'closed';

    // Message type constants
    const TYPE_TEXT = 'text';
    const TYPE_IMAGE = 'image';
    const TYPE_FILE = 'file';
    const TYPE_EMOJI = 'emoji';
    const TYPE_SYSTEM = 'system';

    // Sender type constants
    const SENDER_USER = 'user';
    const SENDER_ADMIN = 'admin';

    // Delivery status constants
    const DELIVERY_SENT = 'sent';
    const DELIVERY_DELIVERED = 'delivered';
    const DELIVERY_READ = 'read';

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(MessageAttachment::class);
    }

    public function replyToMessage(): BelongsTo
    {
        return $this->belongsTo(Message::class, 'reply_to_message_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Message::class, 'reply_to_message_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeReplied($query)
    {
        return $query->where('status', self::STATUS_REPLIED);
    }

    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSED);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeImportant($query)
    {
        return $query->where('is_important', true);
    }

    public function scopeArchived($query)
    {
        return $query->where('is_archived', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_archived', false);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('message_type', $type);
    }

    public function scopeBySender($query, $senderType)
    {
        return $query->where('sender_type', $senderType);
    }

    public function scopeDelivered($query)
    {
        return $query->whereIn('delivery_status', [self::DELIVERY_DELIVERED, self::DELIVERY_READ]);
    }

    public function scopeRead($query)
    {
        return $query->where('delivery_status', self::DELIVERY_READ);
    }

    public function scopeInConversation($query, $conversationId)
    {
        return $query->where('conversation_id', $conversationId);
    }

    // Helper methods
    public function isFromUser()
    {
        return $this->sender_type === self::SENDER_USER;
    }

    public function isFromAdmin()
    {
        return $this->sender_type === self::SENDER_ADMIN;
    }

    public function isRead()
    {
        return $this->delivery_status === self::DELIVERY_READ;
    }

    public function isDelivered()
    {
        return in_array($this->delivery_status, [self::DELIVERY_DELIVERED, self::DELIVERY_READ]);
    }

    public function hasReactions()
    {
        return !empty($this->reactions);
    }

    public function getReactionCount($emoji)
    {
        return $this->reactions[$emoji] ?? 0;
    }

    public function addReaction($emoji, $userId)
    {
        $reactions = $this->reactions ?? [];
        
        if (!isset($reactions[$emoji])) {
            $reactions[$emoji] = [];
        }
        
        if (!in_array($userId, $reactions[$emoji])) {
            $reactions[$emoji][] = $userId;
        }
        
        $this->reactions = $reactions;
        $this->save();
    }

    public function removeReaction($emoji, $userId)
    {
        $reactions = $this->reactions ?? [];
        
        if (isset($reactions[$emoji])) {
            $reactions[$emoji] = array_filter($reactions[$emoji], function($id) use ($userId) {
                return $id != $userId;
            });
            
            if (empty($reactions[$emoji])) {
                unset($reactions[$emoji]);
            }
        }
        
        $this->reactions = $reactions;
        $this->save();
    }

    public function markAsRead()
    {
        $this->update([
            'delivery_status' => self::DELIVERY_READ,
            'read_at' => now()
        ]);
    }

    public function markAsDelivered()
    {
        if ($this->delivery_status === self::DELIVERY_SENT) {
            $this->update([
                'delivery_status' => self::DELIVERY_DELIVERED,
                'delivered_at' => now()
            ]);
        }
    }
}
