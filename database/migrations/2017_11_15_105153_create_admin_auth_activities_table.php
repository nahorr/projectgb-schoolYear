<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminAuthActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_auth_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned()->index()->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->string('user_agent');
            $table->string('ip_address', 45);
            $table->string('ip_city')->nullable();
            $table->string('ip_region')->nullable();
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
        Schema::dropIfExists('admin_auth_activities');
    }
}
