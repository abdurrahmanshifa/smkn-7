<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtikelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artikel', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('id_user')->nullable();
            $table->string('id_kategori')->nullable();
            $table->string('judul')->nullable();
            $table->string('judul_slug')->nullable();
            $table->string('cover')->nullable();
            $table->datetime('tanggal')->nullable();
            $table->integer('view')->nullable()->default(0);
            $table->integer('flag_active')->nullable()->default(0);
            $table->longText('isi_artikel')->nullable();
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
        Schema::dropIfExists('artikel');
    }
}
