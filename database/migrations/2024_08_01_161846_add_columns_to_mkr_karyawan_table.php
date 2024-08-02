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
        Schema::table('mkr_karyawan', function (Blueprint $table) {
            $table->double('gaji_pokok')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mkr_karyawan', function (Blueprint $table) {
            $table->dropColumn('gaji_pokok');
        });
    }
};
