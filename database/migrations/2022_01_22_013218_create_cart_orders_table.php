<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_number');
            $table->string('product_code');
            $table->string('size');
            $table->string('color');
            $table->string('email');
            $table->string('product_name');
            $table->string('total_price');
            $table->text('delivery_address');
            $table->string('contact');
            $table->string('delivery_charge');
            $table->string('order_date');
            $table->string('order_time');
            $table->string('payment_method');
            $table->string('urgent_delivery')->default('no');
            $table->string('order_status');

            $table->foreign('email')->references('email')->on('users');

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
        Schema::dropIfExists('cart_orders');
    }
}
