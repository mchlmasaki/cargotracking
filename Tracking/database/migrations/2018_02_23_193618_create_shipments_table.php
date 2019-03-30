<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sender_name');
            $table->string('sender_contact');
            $table->string('sender_email');
            $table->string('from_location');
            $table->string('nearest_town');
            $table->decimal('from_lat', 10, 7);
            $table->decimal('from_lng', 10, 7);
            $table->string('sender_address');
            $table->string('receiver_name');
            $table->string('receiver_contact');
            $table->string('to_location');
            $table->decimal('to_lat', 10, 7);
            $table->decimal('to_lng', 10, 7);
            $table->string('receiver_address');
            $table->string('type_ofshipment');
            $table->string('product_name');
            $table->string('qty');
            $table->decimal('weight', 9, 3);
            $table->decimal('shipping_rate', 9, 2);
            $table->decimal('shipping_cost', 9, 2);
            $table->string('description');
            $table->string('mode');
            $table->string('cons_no');
            $table->string('status');
            $table->integer('user_id')->unsigned();
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
        Schema::drop('shipments');
    }
}
