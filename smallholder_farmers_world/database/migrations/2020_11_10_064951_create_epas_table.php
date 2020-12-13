<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('district_id');
            $table->string('farmer_id');
            $table->string('supplier_id');
            $table->string('market_id');
            $table->string('advisor_id');
            $table->string('epaname');
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
        Schema::dropIfExists('epas');
    }
}
