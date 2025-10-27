<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Check and add columns only if they don't exist
            if (!Schema::hasColumn('messages', 'conversation_id')) {
                $table->foreignId('conversation_id')->nullable()->after('id')->constrained()->onDelete('cascade');
            }
            
            if (!Schema::hasColumn('messages', 'message_type')) {
                $table->enum('message_type', ['text', 'image', 'file', 'emoji', 'system'])->default('text')->after('message');
            }
            
            if (!Schema::hasColumn('messages', 'sender_type')) {
                $table->enum('sender_type', ['user', 'admin'])->default('user')->after('message_type');
            }
            
            if (!Schema::hasColumn('messages', 'sender_id')) {
                $table->unsignedBigInteger('sender_id')->nullable()->after('sender_type');
            }
            
            if (!Schema::hasColumn('messages', 'delivery_status')) {
                $table->enum('delivery_status', ['sent', 'delivered', 'read'])->default('sent')->after('sender_id');
            }
            
            if (!Schema::hasColumn('messages', 'delivered_at')) {
                $table->timestamp('delivered_at')->nullable()->after('delivery_status');
            }
            
            if (!Schema::hasColumn('messages', 'reactions')) {
                $table->json('reactions')->nullable()->after('delivered_at');
            }
            
            if (!Schema::hasColumn('messages', 'reply_to_message_id')) {
                $table->foreignId('reply_to_message_id')->nullable()->after('reactions')->constrained('messages')->onDelete('set null');
            }
            
            // Make subject nullable for chat messages
            $table->string('subject')->nullable()->change();
        });

        // Populate sender_id for existing messages based on user_id
        // First, clean up any orphaned messages that reference non-existent users
        DB::statement('DELETE FROM messages WHERE user_id NOT IN (SELECT id FROM users)');
        
        // Then populate sender_id for existing messages
        DB::statement('UPDATE messages SET sender_id = user_id WHERE sender_id IS NULL');

        // Now add the foreign key constraint and make sender_id not nullable
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'sender_id')) {
                $table->unsignedBigInteger('sender_id')->nullable(false)->change();
                $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            }
            
            // Add indexes for better performance
            if (!$this->indexExists('messages', 'messages_conversation_id_created_at_index')) {
                $table->index(['conversation_id', 'created_at']);
            }
            if (!$this->indexExists('messages', 'messages_sender_id_sender_type_index')) {
                $table->index(['sender_id', 'sender_type']);
            }
            if (!$this->indexExists('messages', 'messages_delivery_status_index')) {
                $table->index('delivery_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop foreign keys first
            if ($this->foreignKeyExists('messages', 'messages_conversation_id_foreign')) {
                $table->dropForeign(['conversation_id']);
            }
            if ($this->foreignKeyExists('messages', 'messages_sender_id_foreign')) {
                $table->dropForeign(['sender_id']);
            }
            if ($this->foreignKeyExists('messages', 'messages_reply_to_message_id_foreign')) {
                $table->dropForeign(['reply_to_message_id']);
            }
            
            // Drop columns if they exist
            $columnsToCheck = [
                'conversation_id',
                'message_type',
                'sender_type',
                'sender_id',
                'delivery_status',
                'delivered_at',
                'reactions',
                'reply_to_message_id'
            ];
            
            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('messages', $column)) {
                    $table->dropColumn($column);
                }
            }
            
            $table->string('subject')->nullable(false)->change();
        });
    }

    /**
     * Check if an index exists
     */
    private function indexExists($table, $index)
    {
        $indexes = DB::select("SHOW INDEX FROM {$table}");
        foreach ($indexes as $idx) {
            if ($idx->Key_name === $index) {
                return true;
            }
        }
        return false;
    }

    /**
     * Check if a foreign key exists
     */
    private function foreignKeyExists($table, $constraint)
    {
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = '{$table}' 
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ");
        
        foreach ($foreignKeys as $fk) {
            if ($fk->CONSTRAINT_NAME === $constraint) {
                return true;
            }
        }
        return false;
    }
};
