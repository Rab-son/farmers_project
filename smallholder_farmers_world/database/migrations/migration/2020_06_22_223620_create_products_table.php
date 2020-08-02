<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->integer('farmer_id');
            $table->string('market_id');
            $table->string('supplier_id');
            $table->string('supplier_inputs');
            $table->string('product_sold');
            $table->string('product_bought');
            $table->text('description');
            $table->float('price');
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
            $table->string('product_sold_price');
            $table->string('supplier_inputs_price');
            $table->string('supplier_inputs_quantity');
            $table->string('product_bought_price');
            $table->string('product_bought_quantity');
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
