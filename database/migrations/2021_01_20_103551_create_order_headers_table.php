<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_headers', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('user_id');
			$table->double('order_total', 10, 2);
			$table->dateTime('pickup_time');
			$table->string('status')->nullable();
			$table->string('payment_status')->nullable();
			$table->string('comment')->nullable();
			$table->string('pickup_name')->nullable();
			$table->string('phoneNumber')->nullable();
			$table->string('transaction_id')->nullable();
            $table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_headers');
    }
}
