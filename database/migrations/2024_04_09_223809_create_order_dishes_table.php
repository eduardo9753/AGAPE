<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_dishes', function (Blueprint $table) {
            $table->id();

            // Claves foráneas
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('dish_id');
            $table->integer('quantity');

            // Restricciones de clave foránea
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('dish_id')->references('id')->on('dishes')->onDelete('cascade');

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
        Schema::dropIfExists('order_dishes');
    }
}
