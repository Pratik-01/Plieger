<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('task_name');
            $table->string('member_id');
            $table->string('task_id');
            $table->string('team_name');
            $table->string('review_assigned_member');
            $table->date('review_assigned_date');
            $table->time('review_assigned_time');
            $table->time('review_finished_time')->nullable();
            $table->string('total_time_taken')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('reviews');
    }
}
