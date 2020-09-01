<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('productID');
            $table->string('name');
            $table->string('productType');
            $table->string('productGroup');
            $table->double('price')->default(0);
            $table->text('specification')->nullable();
            $table->text('description')->nullable();
            $table->string('imageName')->default('default_product.jpg');
            $table->string('isBidable')->default('NO');
            $table->string('bidStatus')->default('ON');
            $table->unsignedBigInteger('categoryID')->index();
            $table->foreign('categoryID')->references('categoryID')->on('categories')->onDelete('cascade')->onUpdate('No Action');
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
        Schema::dropIfExists('products');
    }
}
