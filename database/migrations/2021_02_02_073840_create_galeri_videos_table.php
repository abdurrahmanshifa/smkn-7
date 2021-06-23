<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeri_video', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('id_user')->nullable()->default(0);
            $table->string('id_kategori')->nullable()->default(0);
            $table->string('judul')->nullable();
            $table->string('judul_slug')->nullable();
            $table->string('link')->nullable();
            $table->string('tags')->nullable();
            $table->datetime('tanggal')->nullable();
            $table->integer('view')->nullable()->default(0);
            $table->integer('flag_active')->nullable()->default(0);
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('galeri_video');
    }
}
