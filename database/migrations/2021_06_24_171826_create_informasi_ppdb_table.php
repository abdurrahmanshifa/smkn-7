<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateInformasiPpdbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_ppdb', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('bg_dark')->nullable();
            $table->string('bg_light')->nullable();
            $table->string('video_tutorial')->nullable();
            $table->string('url')->nullable();
            $table->integer('is_active')->default(0);
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('informasi_ppdb')->insert(
            [
                'id'                => Uuid::uuid4()->getHex(),
                'judul'             => 'Informasi PPDB untuk Tahun 2021',
                'deskripsi'         => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eius to mod tempor incididunt ut labore et dolore magna aliqua. Ut enims ad minim veniam. Aenean massa. Cum sociis natoque penatibus et magnis.',
                'bg_dark'           => 'left-bg.jpg',
                'bg_light'          => 'right-bg.jpg',
                'video_tutorial'    => 'https://www.youtube.com/watch?v=atMUy_bPoQI',
                'is_active'         => '1',
                'url'               => '#',
                'created_at'        => now(),
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi_ppdb');
    }
}
