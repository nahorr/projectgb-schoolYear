<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsychomotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psychomotors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('term_id')->unsigned();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->enum('hand_writting', [1,2,3,4,5]);
            $table->enum('vabal_fluency', [1,2,3,4,5]);
            $table->enum('games_sport', [1,2,3,4,5]);
            $table->enum('handling_of_tools', [1,2,3,4,5]);
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
        Schema::dropIfExists('psychomotors');
    }
}
