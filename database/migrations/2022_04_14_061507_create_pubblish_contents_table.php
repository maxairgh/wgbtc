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
        Schema::create('pubblish_contents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('content_id')->unsigned();
            $table->string('check')->unique();
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('content_id')->references('id')->on('coursecontents')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pubblish_contents');
    }
};
