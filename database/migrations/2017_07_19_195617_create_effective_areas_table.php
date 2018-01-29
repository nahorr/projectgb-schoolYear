<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEffectiveAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('effective_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('term_id')->unsigned();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->enum('punctuality', [1,2,3,4,5]);
            $table->enum('creativity', [1,2,3,4,5]);
            $table->enum('reliability', [1,2,3,4,5]);
            $table->enum('neatness', [1,2,3,4,5]);
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
        Schema::dropIfExists('effective_areas');
    }
}
