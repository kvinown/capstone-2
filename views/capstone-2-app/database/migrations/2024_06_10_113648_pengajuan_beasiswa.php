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
        Schema::create('pengajuanBeasiswa', function (Blueprint $table) {
            $table->string('id',5)->primary();
            $table->decimal('ipk');
            $table->text('dokumen');
            $table->dateTime('tanggal_pengajuan');
            $table->string('status');
            $table->string('users_id');
            $table->string('jenis_beasiswa_id');
            $table->string('periode_pengajuan_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('jenis_beasiswa_id')->references('id')->on('jenisBeasiswa')->onDelete('restrict');
            $table->foreign('periode_pengajuan_id')->references('id')->on('periodePengajuan')->onDelete('restrict');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuanBeasiswa');
    }
};
