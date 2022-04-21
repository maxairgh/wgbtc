<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizquestions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('assess_id')->unsigned();
            $table->longText('question');
            $table->integer('type'); //2 for multiple choise and 
            $table->string('answer1');
            $table->string('answer2');
            $table->string('answer3');
            $table->string('answer4');
            $table->longText('answers');
            $table->timestamps();
            $table->foreign('assess_id')->references('id')->on('assessments')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quizquestions');
    }
};
