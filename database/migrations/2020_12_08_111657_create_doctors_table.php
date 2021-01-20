<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('department_id')->index();
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('No Action')->onUpdate('No Action');
            $table->UnsignedBigInteger('sub_department_id')->index()->nullable();
            $table->foreign('sub_department_id')->references('id')->on('sub_departments')->onDelete('No Action')->onUpdate('No Action');
            $table->string('name',100);
            $table->text('degrees');
            $table->double('checkFee')->default(0);
            $table->string('chamberDetails',100);
            $table->string('mobileNo')->nullable();
            $table->string('time',50);
            $table->longText('description')->nullable();
            $table->string('specialist',100);
            $table->string('imageName',150)->default('default.jpg');
            $table->boolean('isVisible')->default(true);
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
        Schema::dropIfExists('doctors');
    }
}
