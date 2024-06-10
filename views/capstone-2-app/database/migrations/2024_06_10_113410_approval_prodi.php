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
        Schema::create('approvalProdi', function (Blueprint $table) {
            $table->string('id',5)->primary();
            $table->dateTime('tanggal_approval')->unique();
            $table->string('status',45);
            $table->string('program_studi_id');
            $table->string('pengajuan_beasiswa_id');
            $table->foreign('program_studi_id')->references('id')->on('programStudi')->onDelete('restrict');
            $table->foreign('pengajuan_beasiswa_id')->references('id')->on('pengajuanBeasiswa')->onDelete('restrict');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvalProdi');
    }
};
