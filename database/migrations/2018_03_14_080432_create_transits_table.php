<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transits', function (Blueprint $table) {
            $table->increments('id');
            $table->string('container_number');
            $table->string('cons_no')->unique();
            $table->string('status');
            $table->string('from');
            $table->string('to');
            $table->string('current_location');
            $table->decimal('weight', 9, 3);
            $table->timestamps();

            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transits');
    }
}
