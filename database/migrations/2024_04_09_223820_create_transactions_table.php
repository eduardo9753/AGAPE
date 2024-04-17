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
            $table->double('amount');  //monto total de la cuenta
            $table->double('income_tax')->nullable(); //impuesto 
            $table->string('cash_payment')->nullable(); //la moneda o billete del cliente que le da a caja
            $table->string('payment_id')->nullable(); //si quiere meter el id del pago YAPE/PLIN...
            $table->string('payment_method')->nullable(); //yape , tarjeta , plin , others
            $table->string('type_receipt')->nullable(); //boleta factura
            $table->date('payment_date')->nullable();  //fecha del pago
            $table->time('payment_time')->nullable();  //hora del pago

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
