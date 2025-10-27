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
            // Add new tourist category fields
            $table->integer('resident_tourists')->default(0)->after('local_tourists');
            $table->integer('non_resident_tourists')->default(0)->after('resident_tourists');
            $table->integer('foreigner_tourists')->default(0)->after('non_resident_tourists');
            
            // Add nationality tracking for foreigners
            $table->json('foreigner_nationalities')->nullable()->after('foreigner_tourists');
            
            // Add tricycle rental option
            $table->boolean('tricycle_rental')->default(false)->after('transportation');
            $table->decimal('tricycle_fee', 10, 2)->default(0)->after('tricycle_rental');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn([
                'resident_tourists',
                'non_resident_tourists', 
                'foreigner_tourists',
                'foreigner_nationalities',
                'tricycle_rental',
                'tricycle_fee'
            ]);
        });
    }
};
