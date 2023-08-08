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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 255);
			$table->string('nama_karyawan', 255);
			$table->string('tempat_lahir', 255);
			$table->date('tanggal_lahir');
			$table->string('jenis_kelamin');
			$table->string('no_hp', 15);
			$table->text('alamat');
			$table->foreignId('departemen_id')->nullable()->constrained('departments')->restrictOnUpdate()->nullOnDelete();
			$table->foreignId('jabatan_id')->nullable()->constrained('positions')->restrictOnUpdate()->nullOnDelete();
			$table->string('password');
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
        Schema::dropIfExists('employees');
    }
};
