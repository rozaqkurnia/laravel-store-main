<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('order_id');
			$table->unsignedBigInteger('product_id');
			$table->unsignedInteger('qty');
			$table->string('name');
			$table->double('price', 8, 2);
            $table->timestamps();
			
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
			$table->foreign('order_id')->references('id')->on('order_headers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
