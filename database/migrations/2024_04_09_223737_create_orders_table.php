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
            $table->string('state')->default('PENDIENTE');
            $table->string('description')->nullable(); //la descripcion del plato si quiere mucha o poca papa
            $table->string('type')->nullable(); //TIPO: CASA O POR DELIVERY

            // Claves foráneas
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('table_id');
            $table->unsignedBigInteger('user_id');
            $table->string('order_number')->nullable();

            // Restricciones de clave foránea
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
