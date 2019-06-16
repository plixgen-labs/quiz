<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PointTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('pointtransactions', function (Blueprint $table) {
             $table->bigincrements('id');
             $table->integer('user_id')->references('id')->on('profiles')->comment('user id of the user');
             $table->string('type')->comment('type of transcation, credit or debit');
             $table->integer('points')->comment('actual points transcated');
             $table->string('remarks')->nullable()->comment('remarks of the transcation, can add the reason');
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
         Schema::dropIfExists('pointtransactions');
     }
}
