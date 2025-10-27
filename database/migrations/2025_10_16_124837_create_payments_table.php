<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['gcash', 'bank_transfer']);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'pending_verification']);
            $table->json('payment_data')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->boolean('refunded')->default(false);
            $table->string('refund_id')->nullable();
            $table->timestamp('refunded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};