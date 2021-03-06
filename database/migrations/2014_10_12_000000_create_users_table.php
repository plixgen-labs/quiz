<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('isadmin')->default(0);
            $table->string('isactive')->default(1);
            $table->integer('points')->default(0);
            $table->timestamps();
        });

        /** Used to alter table in database directly
         * alter table profiles alter points drop default;
         * alter table profiles alter column points type integer using (trim(points)::integer);
         * alter table profiles alter points set default 0;
         */

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('provider');
            $table->string('provider_id');
            $table->rememberToken();
            $table->integer('user_id')->references('id')->on('profiles')->onDelete('cascade');
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('profiles');
    }
}
