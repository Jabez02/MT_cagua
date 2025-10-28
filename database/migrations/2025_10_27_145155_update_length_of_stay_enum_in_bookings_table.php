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
            // Update the length_of_stay enum to include day_hike and other
            $table->enum('length_of_stay', ['day_hike', 'overnight', 'other'])->default('day_hike')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Revert back to original enum values
            $table->enum('length_of_stay', ['day_trek', 'overnight'])->default('day_trek')->change();
        });
    }
};
