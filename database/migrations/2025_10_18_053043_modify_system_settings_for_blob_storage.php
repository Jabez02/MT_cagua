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
        Schema::table('system_settings', function (Blueprint $table) {
            // Change value column from text to longblob for image storage
            $table->longText('value')->nullable()->change();
            
            // Add a new column to store the image mime type
            $table->string('mime_type')->nullable()->after('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('system_settings', function (Blueprint $table) {
            // Revert value column back to text
            $table->text('value')->nullable()->change();
            
            // Remove the mime_type column
            $table->dropColumn('mime_type');
        });
    }
};
