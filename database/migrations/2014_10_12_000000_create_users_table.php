<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id', 32)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->text('profile_photo_path')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });

        DB::table('users')->insert(
            [
                'id'        => Uuid::uuid4()->getHex(),
                'name'      => 'Abdurrahman Shifa',
                'email'     => 'abdurrahmanshifa@gmail.com',
                'password'  => Hash::make('123'),
                'created_at'=> now(),
                'updated_at'=> null,
            ]
        );

        DB::table('users')->insert(
            [
                'id'        =>  Uuid::uuid4()->getHex(),
                'name'      => 'Dudy Fathan Ali',
                'email'     => 'dudyali@gmail.com',
                'password'  => Hash::make('123'),
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
        Schema::dropIfExists('users');
    }
}
