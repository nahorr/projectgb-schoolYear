<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('staffer_number')->unique();
            $table->string('registration_code')->unique();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('national_card_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('state')->nullable();
            $table->string('current_address')->nullable();
            $table->date('date_of_employment')->nullable();
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
        Schema::dropIfExists('staffers');
    }
}
