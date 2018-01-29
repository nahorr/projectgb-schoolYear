<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('term_id')->unsigned();
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->string('activity_name')->nullable();
            $table->string('activity_description')->nullable();
            $table->string('activity_file')->nullable();
            $table->date('activity_date');
            $table->date('due_date')->nullable();
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
        Schema::dropIfExists('daily_activities');
    }
}
