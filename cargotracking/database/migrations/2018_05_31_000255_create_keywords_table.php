<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeywordsTable extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keywords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('keywords');
            $table->string('town');
            $table->string('county');
            $table->string('points');
            $table->timestamps();
        });
                //insert default Admin
        $values = array(  
array(
            'keywords' => 'furniture',
            'town' => 'Maragua',
            'county' => 'Muranga',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'keywords' => 'boxes',
            'town' => 'Kendu Bay',
            'county' => 'Homa Bay',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  


);

DB::table('keywords')->insert($values);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('keywords');
    }
}
