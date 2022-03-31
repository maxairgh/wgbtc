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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('academyyear_id')->unsigned();
            $table->string('name');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', array('Active', 'Pending','Close'));  
            $table->timestamps();
            $table->foreign('academyyear_id')->references('id')->on('academicyears')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('terms');
    }
};
