<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_menu', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();
            $table->string('link_page')->nullable();
            $table->string('link_custom')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('parent')->default(0)->nullable();
            $table->integer('flag_active')->default(0)->nullable();
            $table->integer('urutan')->default(0)->nullable();
            $table->integer('access_show')->default(0)->nullable();
            $table->integer('access_create')->default(0)->nullable();
            $table->integer('access_update')->default(0)->nullable();
            $table->integer('access_delete')->default(0)->nullable();
            $table->integer('access_detail')->default(0)->nullable();
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
        Schema::dropIfExists('master_menu');
    }
}
