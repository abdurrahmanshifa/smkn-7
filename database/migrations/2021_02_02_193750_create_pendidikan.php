<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreatePendidikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_pendidikan', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('name');
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'SD',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'SMP/Sederajat',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'SMA/Sederajat',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'D1',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'D2',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'D3',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'D4',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'S1',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_pendidikan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'S2',
                'created_at'=> now(),
                'updated_at'=> null,
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
        Schema::dropIfExists('pendidikan');
    }
}
