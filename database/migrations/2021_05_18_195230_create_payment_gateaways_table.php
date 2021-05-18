<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGateawaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateaways', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image');

            $table->string('style')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        DB::table('payment_gateaways')->insert(
            array(
                'name' => 'Paypal',
                'description' => 'PayPal is an electronic commerce company that facilitates payments between parties through online transfers. PayPal allows customers to establish an account on its platform, which is connected to a users credit card or checking account.',
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/1280px-PayPal.svg.png',
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
        Schema::dropIfExists('payment_gateaways');
    }
}
