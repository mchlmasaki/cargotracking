<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedInteger('shipment_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->text('ref_number');
            $table->text('mpesa_merchant_request_id')->nullable();
            $table->string('phone');
            $table->string('amount');
            $table->string('status')->default('payment-pending');
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
        Schema::drop('payments');
    }
}
