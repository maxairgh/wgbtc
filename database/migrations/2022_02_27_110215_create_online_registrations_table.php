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
        Schema::create('online_registrations', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename')->nullable();
            $table->enum('gender', array('Male', 'Female')); 
            $table->date('dob'); 
            $table->enum('status', array('Pending', 'Registered','Declined'));
            $table->enum('marital_status', array('Single', 'Married','Divorced'));
            $table->bigInteger('mobile');
            $table->string('email')->unique();
            $table->string('denomination');
            $table->string('position');
            $table->string('Picture')->nullable();
            $table->bigInteger('program_id')->unsigned();
            $table->timestamps();
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
        Schema::dropIfExists('online_registrations');
    }
};
