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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('users')->cascadeOnDelete();

            $table->date('date');
            $table->string('day_name');

            $table->time('start_time');
            $table->time('end_time');

            $table->boolean('is_booked')->default(false);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index(['doctor_id', 'date', 'is_booked']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_schedules', function (Blueprint $table) {
            //
        });
    }
};
