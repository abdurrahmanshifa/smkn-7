<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('nip')->nullable();
            $table->string('nama');
            $table->string('tmpt_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jns_kelamin')->nullable();
            $table->string('email');
            $table->string('telp')->nullable();
            $table->string('agama')->nullable();
            $table->string('pend_terakhir')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('foto')->nullable();
            $table->text('alamat')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru');
    }
}
