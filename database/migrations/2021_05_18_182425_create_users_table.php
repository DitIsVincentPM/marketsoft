<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at');
            $table->string('profile_picture');
            $table->string('password');
            $table->string('remember_token')->nullable()
            $table->foreign('role_id')->references('id')->on('roles');
            $table->integer('is_banned');
            $table->integer('status')->default(1);
            $table->string('discord_id');
            $table->string('github_id');
            $table->string('google_id');
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
        Schema::dropIfExists('users');
    }
}
