<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->index()->nullable()->comment('ID пользователя');
            $table->string('email')->comment('Электронная почта')->nullable();
            $table->string('phone_number', 11)->comment('Номер телефона')->nullable();
            $table->integer('quantity')->default(0)->unsigned()->comment('Количество товаров');
            $table->decimal('total', 9, 2)->default(0)->comment('Итого');
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
        Schema::dropIfExists('checkouts');
    }
}
