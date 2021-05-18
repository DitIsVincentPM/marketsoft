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
            $table->string('profile_picture')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->foreignId('role_id')->constrained('roles')->nullable();
            $table->integer('is_banned')->default(0);
            $table->integer('status')->default(1);
            $table->string('discord_id')->nullable();
            $table->string('github_id')->nullable();
            $table->string('google_id')->nullable();
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
