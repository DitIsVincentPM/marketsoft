<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value');
        });

        DB::table('settings')->insert(
            array(
                'value' => 'MarketSoft',
                'key' => 'CompanyName',
            )
        );
        DB::table('settings')->insert(
            array(
                'value' => 'https://cdn.discordapp.com/attachments/844250154914807898/844344841387245568/favicon.png',
                'key' => 'CompanyFavicon',
            )
        );
        DB::table('settings')->insert(
            array(
                'value' => '0',
                'key' => 'GithubStatus',
            )
        );
        DB::table('settings')->insert(
            array(
                'value' => '0',
                'key' => 'DiscordStatus',
            )
        );
        DB::table('settings')->insert(
            array(
                'value' => '0',
                'key' => 'GoogleStatus',
            )
        );
<<<<<<< HEAD
        DB::table('settings')->insert(
            array(
                'value' => 'Nothing',
                'key' => 'ProductNotice',
            )
        );
        DB::table('settings')->insert(
            array(
                'value' => 'example@email.com',
                'key' => 'SupportMail',
            )
        );
    }
=======
    }

>>>>>>> c8d33c0b61c122a246ada53730a08f0b631e470a
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
