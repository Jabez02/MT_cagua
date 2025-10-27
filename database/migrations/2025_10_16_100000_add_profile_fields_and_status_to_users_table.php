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
        Schema::table('users', function (Blueprint $table) {
            $table->string('contact_number')->nullable()->after('email');
            $table->string('address')->nullable()->after('contact_number');
            $table->string('emergency_contact_name')->nullable()->after('address');
            $table->string('emergency_contact_number')->nullable()->after('emergency_contact_name');
            $table->enum('nationality', ['local', 'foreign'])->default('local')->after('emergency_contact_number');
            $table->string('status')->default('pending')->after('usertype'); // pending, approved, rejected
            $table->timestamp('approved_at')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'contact_number',
                'address',
                'emergency_contact_name',
                'emergency_contact_number',
                'nationality',
                'status',
                'approved_at',
            ]);
        });
    }
};