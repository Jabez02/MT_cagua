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
        // Add indexes to improve query performance for date-based availability checks
        Schema::table('bookings', function (Blueprint $table) {
            // Add composite index for guide availability checks
            $table->index(['guide_id', 'trek_date'], 'idx_bookings_guide_date');
            
            // Add composite index for porter availability checks
            $table->index(['porter_id', 'trek_date'], 'idx_bookings_porter_date');
            
            // Add index for date-based queries
            $table->index('trek_date', 'idx_bookings_trek_date');
            
            // Add index for status-based queries
            $table->index('status', 'idx_bookings_status');
        });

        // Create a view for active bookings to simplify conflict checking
        DB::statement("
            CREATE VIEW active_bookings AS
            SELECT id, user_id, guide_id, porter_id, trek_date, start_time, status, created_at, updated_at
            FROM bookings 
            WHERE status NOT IN ('cancelled', 'completed')
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the view
        DB::statement("DROP VIEW IF EXISTS active_bookings");
        
        // Remove indexes
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex('idx_bookings_guide_date');
            $table->dropIndex('idx_bookings_porter_date');
            $table->dropIndex('idx_bookings_trek_date');
            $table->dropIndex('idx_bookings_status');
        });
    }
};
