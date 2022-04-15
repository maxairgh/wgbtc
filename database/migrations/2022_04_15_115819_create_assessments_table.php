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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('assesstype_id')->unsigned();
            $table->longText('content');
            $table->string('attachment');
            $table->dateTime('duedate');
            $table->integer('quiz');
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('assesstype_id')->references('id')->on('assesstypes')->onDelete('restrict')->onUpdate('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assessments');
    }
};
