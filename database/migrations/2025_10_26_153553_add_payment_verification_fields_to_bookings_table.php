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
        Schema::table('bookings', function (Blueprint $table) {
            $table->timestamp('payment_verified_at')->nullable()->after('approved_at');
            $table->unsignedBigInteger('payment_verified_by')->nullable()->after('payment_verified_at');
            $table->text('verification_notes')->nullable()->after('payment_verified_by');
            $table->timestamp('payment_rejected_at')->nullable()->after('verification_notes');
            $table->unsignedBigInteger('payment_rejected_by')->nullable()->after('payment_rejected_at');
            $table->string('rejection_reason')->nullable()->after('payment_rejected_by');
            $table->text('rejection_notes')->nullable()->after('rejection_reason');
            
            // Add foreign key constraints
            $table->foreign('payment_verified_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('payment_rejected_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['payment_verified_by']);
            $table->dropForeign(['payment_rejected_by']);
            $table->dropColumn([
                'payment_verified_at',
                'payment_verified_by',
                'verification_notes',
                'payment_rejected_at',
                'payment_rejected_by',
                'rejection_reason',
                'rejection_notes'
            ]);
        });
    }
};
