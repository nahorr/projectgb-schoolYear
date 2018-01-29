<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_number')->unique();
            $table->string('registration_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('dob');
            $table->date('date_enrolled')->nullable();
            $table->date('date_graduated')->nullable();
            $table->date('date_unenrolled')->nullable();
            $table->string('nationality')->nullable();
            $table->string('national_card_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('state')->nullable();
            $table->string('current_address')->nullable();
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
        Schema::dropIfExists('students');
    }
}
