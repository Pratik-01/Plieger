<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('name');
            $table->string('image_name')->nullable();
            $table->string('image_type')->nullable();
            $table->string('image_size')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('mobile_no');
            $table->string('role_id');
            $table->string('role_title')->nullable();
            $table->string('team_id');
            $table->string('total_assigned_task')->nullable();
            $table->string('total_reviewed_task')->nullable();
            $table->string('address');
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
        Schema::dropIfExists('members');
    }
}
