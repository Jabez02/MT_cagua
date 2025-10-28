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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('foreign_tourists')->default(0);
            $table->integer('local_tourists')->default(0);
            $table->enum('length_of_stay', ['day_trek', 'overnight'])->default('day_trek');
            $table->enum('transportation', ['own_vehicle', 'rent_trike'])->default('own_vehicle');
            $table->json('health_issues')->nullable();
            $table->decimal('tourist_fee', 10, 2);
            $table->decimal('guide_fee', 10, 2);
            $table->decimal('porter_fee', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->decimal('down_payment', 10, 2);
            $table->enum('payment_method', ['gcash', 'bank_transfer', 'cash'])->default('gcash');
            $table->string('payment_reference')->nullable();
            $table->enum('meeting_place', ['tourism_office', 'museum'])->default('tourism_office');
            $table->boolean('terms_agreed')->default(false);
            $table->enum('status', ['pending', 'payment_pending', 'confirmed', 'completed', 'cancelled', 'rejected'])->default('pending');
            $table->foreignId('guide_id')->nullable()->constrained('guides');
            $table->foreignId('porter_id')->nullable()->constrained('porters');
            $table->dateTime('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->text('cancellation_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
