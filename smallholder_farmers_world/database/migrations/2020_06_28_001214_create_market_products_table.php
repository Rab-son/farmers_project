<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('market_id');
            $table->string('product_name');
            $table->string('selling_price');
            $table->string('buying_price');
            $table->text('description');
            $table->float('amount');
            $table->string('status');
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
        Schema::dropIfExists('market_products');
    }
}
