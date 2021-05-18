<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon');
            $table->string('color');
            $table->timestamps();
        });

        DB::table('roles')->insert(
            array(
                'name' => 'Member',
                'description' => 'The default role for all users.',
                'icon' => 'cube',
                'color' => '#010101',
            )
        );

        DB::table('roles')->insert(
            array(
                'name' => 'Admin',
                'description' => 'The default admin role for all users.',
                'icon' => 'cube',
                'color' => '#771200',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
