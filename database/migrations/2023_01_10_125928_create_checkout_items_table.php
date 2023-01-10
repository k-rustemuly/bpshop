<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkout_items', function (Blueprint $table) {
            $table->id();
            $table->integer('checkout_id')->unsigned()->index()->comment('ID заказа');
            $table->integer('product_id')->unsigned()->index()->comment('ID товара');
            $table->unique(['product_id', 'checkout_id']);
            $table->decimal('price', 9, 2);
            $table->integer('quantity')->unsigned();
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
        Schema::dropIfExists('checkout_items');
    }
}
