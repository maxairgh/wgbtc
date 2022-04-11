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
        Schema::create('coursecontents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('course_id')->unsigned();
            $table->string('chapter');
            $table->string('title');
            $table->string('video');
            $table->integer('status');
            $table->longText('details');
            $table->integer('order');
            $table->timestamps();
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
        Schema::dropIfExists('coursecontents');
    }
};
