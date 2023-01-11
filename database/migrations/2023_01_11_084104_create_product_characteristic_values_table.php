<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCharacteristicValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_characteristic_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id')->index();
            $table->unsignedInteger('characteristic_id')->index();
            $table->unique(['product_id', 'characteristic_id'], 'eav_unique');
            $table->text('value');
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
        Schema::dropIfExists('product_characteristic_values');
    }
}
