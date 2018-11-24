<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('text')->nullable()->comment('text for the image');
            $table->text('source')->comment('source of the image, can be link, can be stored localy');
            $table->integer('user_id')->references('id')->on('profiles')->comment('user id of the user who uploaded the image');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('text')->comment('question which is shown to the user')->default('Find the relationship between the following pictures');
            $table->string('hint')->nullable()->comment('hint to help the user');
            $table->longText('image')->comment('comma seperted id link to image table or link/source');
            $table->string('bgimage')->nullable()->comment('image link/source for the background of the page or id to table image');
            $table->longText('answer')->comment('comma seperated answer list');
            $table->integer('difficulty')->nullable()->comment('scale of 1 to 10 as the multiplication factor of the base point');
            $table->integer('user_id')->references('id')->on('profiles')->comment('user id of the user who created the question');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('profiles');
            $table->integer('question_id')->references('id')->on('questions');
            $table->string('answer');
            $table->boolean('result');
            $table->string('note');
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
        Schema::dropIfExists('answers');
        Schema::dropIfExists('questions');
        Schema::dropIfExists('images');
    }
}
