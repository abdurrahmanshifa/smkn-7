<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Uuid;

class CreateTautanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tautan', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('judul')->nullable();
            $table->string('icon')->nullable();
            $table->string('url')->nullable();
            $table->string('bg_color')->nullable();
            $table->string('bg_img')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('tautan')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'judul'         => 'University Life',
                'icon'          => '1.png',
                'url'           => 'javascript:void(0);',
                'bg_color'      => '#273c66',
                'bg_img'        => '1.jpg',
                'created_at'    => now(),
            ]
        );
        DB::table('tautan')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'judul'         => 'Graduation',
                'icon'          => '2.png',
                'url'           => 'javascript:void(0);',
                'bg_color'      => '#21a7d0',
                'bg_img'        => '1.jpg',
                'created_at'    => now(),
            ]
        );
        DB::table('tautan')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'judul'         => 'Social',
                'icon'          => '3.png',
                'url'           => 'javascript:void(0);',
                'bg_color'      => '#772bea',
                'bg_img'        => '1.jpg',
                'created_at'    => now(),
            ]
        );
        DB::table('tautan')->insert(
            [
                'id'            => Uuid::uuid4()->getHex(),
                'judul'         => 'Athletics',
                'icon'          => '1.png',
                'url'           => 'javascript:void(0);',
                'bg_color'      => '#16aaca',
                'bg_img'        => '1.jpg',
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
        Schema::dropIfExists('tautan');
    }
}
