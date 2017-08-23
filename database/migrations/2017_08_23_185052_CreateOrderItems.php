<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->bigInteger('order_id')->unsigned()->nullable();
        $table->foreign('order_id')->references('id')->on('orders');
        $table->integer('item_id')->unsigned()->nullable();
        $table->foreign('item_id')->references('id')->on('items');
        $table->boolean('is_complementary');
        $table->dateTime('date');
        $table->timestamps();
        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
