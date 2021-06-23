<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class CreateMasterJabatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_jabatan', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('name');
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('master_jabatan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Guru',
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('master_jabatan')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Staff',
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
        Schema::dropIfExists('master_jabatan');
    }
}
