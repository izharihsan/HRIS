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
        Schema::create('hr_absences', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->enum('type', ['clock_in', 'clock_out', 'forgot_clock_in', 'forgot_clock_out']);
            $table->boolean('late')->default(false);
            $table->timestamp('timestamp');
            $table->date('tanggal');
            $table->string('lat');
            $table->string('lng');
            $table->string('proof_image');
            $table->string('face_recognition');
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absences');
    }
};
