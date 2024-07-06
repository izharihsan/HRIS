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
        Schema::create('hr_master_timeoffs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('periode')->nullable();
            $table->integer('kuota')->default(0);
            $table->boolean('is_attachment_required')->default(false);
            $table->integer('attachment_required_in_days')->default(0);
            $table->string('status')->default('Aktif');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_timeoffs');
    }
};
