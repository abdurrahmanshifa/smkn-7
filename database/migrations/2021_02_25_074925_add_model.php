<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddModel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('master_menu', 'page_type'))
        {
            Schema::table('master_menu', function (Blueprint $table) {
                $table->string('page_type')->nullable()->after('label');
            });
        }
        if (!Schema::hasColumn('master_menu', 'model_tabel'))
        {
            Schema::table('master_menu', function (Blueprint $table) {
                $table->string('model_tabel')->nullable()->after('link_custom');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_menu', function (Blueprint $table) {
            $table->dropColumn('model_tabel');
            $table->dropColumn('page_type');
        });
    }
}
