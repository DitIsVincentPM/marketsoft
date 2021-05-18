<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('group');
            $table->string('key')->default(0);
            $table->text('desc');
            $table->timestamps();
        });

        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'general',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'mail',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'modules',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'addon',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'theme',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'roles',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Admin',
                'key' => 'View',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'legal',
                'desc' => '0',
            )
        );
        DB::table('permissions')->insert(
            array(
                'group' => 'Settings',
                'key' => 'oauth2',
                'desc' => '0',
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
        Schema::dropIfExists('permissions');
    }
}
