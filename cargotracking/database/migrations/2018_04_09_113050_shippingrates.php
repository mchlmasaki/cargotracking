<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Shippingrates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shippingrates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('weight_from')->unique();
            $table->string('weight_to')->unique();
            $table->decimal('rate', 9, 2);
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
        Schema::drop('shippingrates');
    }
}
