<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('siswa')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'nama'          => 'Testing I',
                'tgl_lahir'     => '2021-03-10',
                'jenis_kelamin' => '7b0e838cf417482783036fbaf8681b4f',
                'created_at'    => now(),
            ]
        );
        DB::table('siswa')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'nama'          => 'Testing II',
                'tgl_lahir'     => '2021-03-10',
                'jenis_kelamin' => '7b0e838cf417482783036fbaf8681b4f',
                'created_at'    => now(),
            ]
        );
        DB::table('siswa')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'nama'          => 'Testing III',
                'tgl_lahir'     => '2021-03-10',
                'jenis_kelamin' => '7b0e838cf417482783036fbaf8681b4f',
                'created_at'    => now(),
            ]
        );
        DB::table('siswa')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'nama'          => 'Testing IV',
                'tgl_lahir'     => '2021-03-10',
                'jenis_kelamin' => '7b0e838cf417482783036fbaf8681b4f',
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
        Schema::dropIfExists('siswa');
    }
}
