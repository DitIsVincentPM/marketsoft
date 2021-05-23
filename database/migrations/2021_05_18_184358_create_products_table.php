<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('name');
            $table->text('description');
            $table->foreignId('category')->constrained('product_categorys');
            $table->float('price');
            $table->integer('type');
            $table->integer('purchases')->default(0);
            $table->integer('downloads')->default(0);
            $table->integer('views')->default(0);
            $table->integer('status');
            $table->foreignId('seller_id')->constrained('users');
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
        Schema::dropIfExists('products');
    }
}
