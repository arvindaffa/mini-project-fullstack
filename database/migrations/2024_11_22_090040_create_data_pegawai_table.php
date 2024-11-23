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
        Schema::create('data_pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->string('email', 255)->unique();
            $table->string('departemen', 100)->nullable();
            $table->integer('umur')->nullable();
            $table->enum('jenis_kelamin', ['Pria', 'Wanita'])->nullable();
            $table->date('tanggal_masuk');
            $table->string('foto', 255)->nullable();
            $table->string('cv', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pegawai');
    }
};
