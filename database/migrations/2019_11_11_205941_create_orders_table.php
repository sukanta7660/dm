<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('orderID');
            $table->double('paidAmount')->default(0);
            $table->double('deliveryCharge')->default(0);
            $table->double('discount')->default(0);
            $table->string('paymentType', 50)->default('Cash');
            $table->string('transactionID', 50);
            $table->string('paymentStatus', 20)->default('Unpaid');
            $table->string('orderStatus', 20)->default('Pending');
            $table->string('orderType', 30)->default('General');
            $table->string('contactNo')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('deliveryDate')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('userID')->index()->nullable();
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade')->onUpdate('No Action');
            $table->softDeletes();
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
