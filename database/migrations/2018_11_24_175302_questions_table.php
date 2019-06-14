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
            $table->string('type')->nullable()->comment('type of media it is, i.e extention of media, eg. jpg for image, mp3 for sound etc');
            $table->timestamps();
        });

        Schema::create('questions', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->string('qid')->unique()->comment('question id to be shown to the user');
            $table->string('text')->comment('question which is shown to the user')->default('What is common between these two pictures?');
            $table->string('hint')->nullable()->comment('hint to help the user');
            $table->longText('image')->comment('comma seperted id link to image table or link/source');
            $table->string('bgimage')->nullable()->comment('image link/source for the background of the page or id to table image');
            $table->longText('answer')->comment('comma seperated answer list');
            $table->integer('difficulty')->nullable()->comment('scale of 1 to 10 as the multiplication factor of the base point');
            $table->integer('user_id')->references('id')->on('profiles')->comment('user id of the user who created the question');
            $table->string('region')->nullable()->comment('defines the specific region of the question');
            $table->integer('votes')->default(0)->comment('disable the question if the votes are in negative');
            $table->boolean('enable')->default(1)->comment('wont show the question if not enabled');
            $table->timestamps();
        });

        Schema::create('answers', function (Blueprint $table) {
            $table->bigincrements('id');
            $table->integer('user_id')->references('id')->on('profiles');
            $table->integer('question_id')->references('id')->on('questions');
            $table->string('answer');
            $table->boolean('result')->comment('mark the given answer as true or false');
            $table->string('note');
            $table->integer('points_awarded')->default(0);
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
