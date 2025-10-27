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
            $table->date('trek_date')->after('user_id');
            $table->time('start_time')->after('trek_date');
            $table->string('trail')->default('Sta. Clara Trail (Back-Trail Only)')->after('start_time');
            $table->unsignedBigInteger('hike_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['trek_date', 'start_time', 'trail']);
            $table->unsignedBigInteger('hike_id')->nullable(false)->change();
        });
    }
};
