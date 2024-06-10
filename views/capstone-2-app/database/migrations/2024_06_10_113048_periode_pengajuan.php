<?php

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('periodePengajuan', function (Blueprint $table) {
            $table->string('id',5)->primary();
            $table->string('nama_periode',100)->unique();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');
            $table->string('program_studi_id');
            $table->foreign('program_studi_id')->references('id')->on('programStudi')->onDelete('restrict');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('periodePengajuan');
    }
};
