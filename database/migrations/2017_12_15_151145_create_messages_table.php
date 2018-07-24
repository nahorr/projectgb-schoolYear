<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->string('body');
            $table->boolean('status')->default(false);
            $table->string('message_file')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('staffer_id')->unsigned();
            $table->foreign('staffer_id')->references('id')->on('staffers')->onDelete('cascade');
            $table->boolean('user_delete')->default(false);
            $table->boolean('staffer_delete')->default(false);
            $table->integer('message_replied')->nullable()->unsigned();
            $table->integer('sent_to_student')->nullable()->unsigned();
            $table->integer('sent_to_staffer')->nullable()->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('messages');
    }
}
