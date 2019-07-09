<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
            $table->date('from');
            $table->date('to');
            $table->integer('duration');
            $table->string('reason');
            $table->string('reject_message');
            $table->integer('status')->default('1')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->integer('role_id')->nullable()->unsigned();
            $table->integer('manager_id')->nullable()->unsigned();
            $table->timestamps();
            
        });

        Schema::table('leaves', function (Blueprint $table) {
            $table->foreign('status')->references('id')->on('statuses');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('manager_id')->references('id')->on('supervisors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leaves');
    }
}
