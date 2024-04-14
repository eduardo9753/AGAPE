<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double('amount');
            $table->string('payment_method'); //yape , tarjeta , plin , others
            $table->string('type_receipt'); //boleta factura
            $table->date('payment_date')->nullable();
            $table->time('payment_time')->nullable();

            // Claves foráneas
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');

            // Restricciones de clave foránea
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
}
