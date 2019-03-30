<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('contact');
            $table->string('role');
            $table->string('password');
            $table->rememberToken();
            $table->boolean('verified');
            $table->timestamps();
        });
        //insert default Admin
        $values = array(
   array(
            'name' => 'ALLAN KIPTALAM',
            'email' => 'kiptalam54@gmail.com',
            'contact' => '+254716524892',
            'role' => 'Admin',
            'password' => '$2y$10$Isw9uxBLlctKm5VqBbASjuv2joBgEMY59x2NUtKs.5hw.PFyLa/VO',
            'verified' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
   array(
            'name' => 'STACY CHEMTAI',
            'email' => 'stacychemtai@gmail.com',
            'contact' => '+254716524892',
            'role' => 'Employee',
            'password' => '$2y$10$Isw9uxBLlctKm5VqBbASjuv2joBgEMY59x2NUtKs.5hw.PFyLa/VO',
            'verified' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
   array(
            'name' => 'CALEB MWANGA',
            'email' => 'calebmwanga@gmail.com',
            'contact' => '+254716524892',
            'role' => 'Client',
            'password' => '$2y$10$Isw9uxBLlctKm5VqBbASjuv2joBgEMY59x2NUtKs.5hw.PFyLa/VO',
            'verified' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
);

DB::table('users')->insert($values);

    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
