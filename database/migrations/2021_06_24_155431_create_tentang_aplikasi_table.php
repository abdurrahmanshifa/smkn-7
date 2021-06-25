<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateTentangAplikasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentang_aplikasi', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('tentang_aplikasi')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'judul'         => 'Selamat Datang Di Web Sekolah',
                'deskripsi'     => 'Lorem ipsum dolor sit amet, consectetur adipisic ing elit, sed eius to mod tempors incididunt ut labore et dolore magna this aliqua enims ad minim.',
                'foto'          => null,
                'created_at'    => now(),
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
        Schema::dropIfExists('tentang_aplikasi');
    }
}
