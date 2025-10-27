<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(); // Optional conversation title
            $table->enum('type', ['support', 'general'])->default('support'); // Conversation type
            $table->enum('status', ['active', 'closed', 'archived'])->default('active');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who started the conversation
            $table->foreignId('admin_id')->nullable()->constrained('users')->onDelete('set null'); // Assigned admin
            $table->timestamp('last_message_at')->nullable(); // Last message timestamp
            $table->json('participants')->nullable(); // JSON array of participant IDs
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['admin_id', 'status']);
            $table->index('last_message_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
