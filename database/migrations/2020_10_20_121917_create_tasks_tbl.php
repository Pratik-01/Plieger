<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name')->unique();
            $table->string('member_id');
            $table->string('team_name');
            $table->string('assigned_member')->nullable();
            $table->date('assigned_date');
            $table->string('review_assigned_member')->nullable();
            $table->date('finished_date')->nullable();
            $table->string('time_taken')->nullable();
            $table->string('issue_remark')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('tasks');
    }
}
