<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreateJnsKelamin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_jns_kelamin', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('name');
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('master_jns_kelamin')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Laki - laki',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_jns_kelamin')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Perempuan',
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
        Schema::dropIfExists('jns_kelamin');
    }
}
