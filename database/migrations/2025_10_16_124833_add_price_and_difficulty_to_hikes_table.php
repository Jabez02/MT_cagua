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
        Schema::table('hikes', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->default(0.00)->after('trail');
            $table->enum('difficulty', ['easy', 'moderate', 'hard'])->default('moderate')->after('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hikes', function (Blueprint $table) {
            $table->dropColumn(['price', 'difficulty']);
        });
    }
};