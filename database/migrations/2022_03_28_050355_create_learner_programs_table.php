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
        Schema::create('learner_programs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('learner_id')->unsigned();
            $table->bigInteger('program_id')->unsigned();
            $table->string('checks');
            $table->dateTime('startdate');
            $table->dateTime('enddate')->nullable();
            $table->timestamps();
            $table->foreign('learner_id')->references('id')->on('learners')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('restrict')->onUpdate('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('learner_programs');
    }
};
