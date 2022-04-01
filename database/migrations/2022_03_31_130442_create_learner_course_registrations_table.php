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
        Schema::create('learner_course_registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('learner_id')->unsigned();
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('course_id')->unsigned();
            $table->string('checks')->unique();
            $table->timestamps();
            $table->foreign('learner_id')->references('id')->on('learners')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learner_course_registrations');
    }
};
