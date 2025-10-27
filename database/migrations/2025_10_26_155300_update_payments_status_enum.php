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
        Schema::table('payments', function (Blueprint $table) {
            // Update the status enum to include 'rejected'
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'pending_verification', 'rejected', 'verified'])->change();
            
            // Add rejected_at and rejected_by fields
            $table->timestamp('rejected_at')->nullable()->after('verified_by');
            $table->unsignedBigInteger('rejected_by')->nullable()->after('rejected_at');
            $table->foreign('rejected_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            // Remove rejected fields
            $table->dropForeign(['rejected_by']);
            $table->dropColumn(['rejected_at', 'rejected_by']);
            
            // Revert status enum
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded', 'pending_verification'])->change();
        });
    }
};