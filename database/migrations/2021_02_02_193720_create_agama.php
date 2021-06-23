<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreateAgama extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_agama', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('name');
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Islam',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Kristen',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Katholik',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Hindu',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Buddha',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Konghucu',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_agama')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Lainnya',
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
        Schema::dropIfExists('agama');
    }
}
