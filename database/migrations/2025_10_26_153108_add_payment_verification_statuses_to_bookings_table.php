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
            // Modify the status enum to include new payment verification statuses
            $table->enum('status', [
                'pending', 
                'payment_pending', 
                'payment_verification_pending', 
                'confirmed', 
                'completed', 
                'cancelled', 
                'rejected',
                'payment_rejected'
            ])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Revert back to original status enum
            $table->enum('status', [
                'pending', 
                'payment_pending', 
                'confirmed', 
                'completed', 
                'cancelled', 
                'rejected'
            ])->default('pending')->change();
        });
    }
};
