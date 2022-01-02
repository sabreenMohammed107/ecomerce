<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_no')->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->text('address')->nullable();
            $table->integer('payway')->nullable();
            $table->integer('payment_id')->nullable();
            $table->dateTime('order_date',0)->nullable();
            $table->integer('copoun')->nullable();
            $table->float('subtotally',8,2)->nullable();
            $table->float('tax',8,2)->nullable();
            $table->float('delivery_cost',8,2)->nullable();
            $table->float('total',8,2)->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('orders');
    }
}
