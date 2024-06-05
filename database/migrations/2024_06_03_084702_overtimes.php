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
        Schema::create('hr_overtimes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->text('message');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('overtime_date');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->text('status_message')->nullable();
            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
            $table->date('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimes');
    }
};
