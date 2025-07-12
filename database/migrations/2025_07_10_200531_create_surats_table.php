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
        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat');
            $table->string('perihal_surat');
            $table->date('tanggal');
            $table->string('isi');
            $table->string('ttd_1');
            $table->string('ttd_2');
            $table->string('ttd_3')->nullable();
            $table->string('ttd_4')->nullable();
            $table->string('ttd_5')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surats');
    }
};
