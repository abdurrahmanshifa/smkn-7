<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomentarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komentar_balasan', function (Blueprint $table) {
            $table->id();
            $table->string('id_artikel',32)->nullable();
            $table->integer('id_komentar')->default(0)->nullable();
            $table->string('id_user',32)->nullable();
            $table->string('judul_balasan')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('flag_active')->default(0)->nullable();
            $table->text('isi_balasan')->nullable();
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
        Schema::dropIfExists('komentar_balasan');
    }
}
