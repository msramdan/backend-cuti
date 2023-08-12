<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('employees')->restrictOnUpdate()->cascadeOnDelete();
			$table->string('jenis_cuti');
			$table->date('tanggal_akhir');
			$table->date('tanggal_awal');
			$table->text('alasan');
			$table->string('file');
			$table->dateTime('tanggal_pengajuan');
			$table->string('status_pengajuan');
			$table->foreignId('user_id')->nullable()->constrained('users')->restrictOnUpdate()->nullOnDelete();
            $table->string('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuans');
    }
};
