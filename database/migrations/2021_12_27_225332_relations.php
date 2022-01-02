<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //  This is Realations for the users Table ..
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('addresses');
        });
          //  This is Realations for the product_colors Table ..
           Schema::table('product_colors', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('color_id')->references('id')->on('colors');
        });
        //  This is Realations for the product_sizes Table ..
        Schema::table('product_sizes', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('size_id')->references('id')->on('sizes');
        });

        //  This is Realations for the product_components Table ..
        Schema::table('product_components', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
        });

        //  This is Realations for the products Table ..
        Schema::table('products', function (Blueprint $table) {

            $table->foreign('category_id')->references('id')->on('categories');

        });


        //  This is Realations for the product_rates Table ..
        Schema::table('product_rates', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });

 //  This is Realations for the carts Table ..
 Schema::table('carts', function (Blueprint $table) {
    $table->foreign('product_id')->references('id')->on('products');
    $table->foreign('product_size')->references('id')->on('product_sizes');
    $table->foreign('product_color')->references('id')->on('product_colors');
    $table->foreign('user_id')->references('id')->on('users');
});

//  This is Realations for the carts Table ..
Schema::table('cart_items', function (Blueprint $table) {
    $table->foreign('cart_id')->references('id')->on('carts');
    $table->foreign('product_id')->references('id')->on('products');
});


 //  This is Realations for the orders Table ..
 Schema::table('orders', function (Blueprint $table) {
    $table->foreign('user_id')->references('id')->on('users');
    // $table->foreign('address_id')->references('id')->on('addresses');
          });

  //  This is Realations for the order_items Table ..
  Schema::table('order_items', function (Blueprint $table) {
    $table->foreign('order_id')->references('id')->on('orders');
    $table->foreign('cart_id')->references('id')->on('carts');
    $table->foreign('product_id')->references('id')->on('products');

});

Schema::table('home_sliders', function (Blueprint $table) {
    $table->foreign('category_id')->references('id')->on('categories');

    $table->foreign('product_id')->references('id')->on('products');

});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
