<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('towns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('town')->unique();
            $table->string('county');
            $table->string('points');
            $table->timestamps();
        });
                //insert default Admin
        $values = array(
            array(
            'town' => 'Nairobi',
            'county' => 'Nairobi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
        
array(
            'town' => 'Mombasa',
            'county' => 'Mombasa',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kisumu',
            'county' => 'Kisumu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nakuru',
            'county' => 'Nakuru',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Eldoret',
            'county' => 'Uasin Gishu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kehancha Munici',
            'county' => 'Migori',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ruiru',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kikuyu',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kangundo-Tala',
            'county' => 'Machakos',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Malindi',
            'county' => 'Kilifi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Naivasha',
            'county' => 'Nakuru',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kitui',
            'county' => 'Kitui',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Machakos',
            'county' => 'Machakos',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Thika',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Athi River/Mavoko',
            'county' => 'Machakos',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Karuri',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyeri',
            'county' => 'Nyeri',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kilifi',
            'county' => 'Kilifi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Garissa',
            'county' => 'Garissa',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Vihiga',
            'county' => 'Vihiga',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Mumias',
            'county' => 'Kakamega',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Bomet',
            'county' => 'Bomet',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Molo',
            'county' => 'Nakuru',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),      
array(
            'town' => 'Ngong',
            'county' => 'Kajiado',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kitale',
            'county' => 'Trans-Nzoia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Litein',
            'county' => 'Kericho',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Limuru',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kericho',
            'county' => 'Kericho',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kimilili',
            'county' => 'Bungoma',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Awasi',
            'county' => 'Kisumu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kakamega',
            'county' => 'Kakamega',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kapsabet',
            'county' => 'Nandi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mariakani',
            'county' => 'Kilifi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kiambu',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mandera',
            'county' => 'Mandera',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyamira',
            'county' => 'Nyamira',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mwingi',
            'county' => 'Kitui',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kisii',
            'county' => 'Kisii',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Wajir',
            'county' => 'Wajir',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Rongo',
            'county' => 'Migori',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Bungoma',
            'county' => 'Bungoma',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ahero',
            'county' => 'Kisumu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
    
array(
            'town' => 'Makuyu',
            'county' => 'Muranga',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kapenguria',
            'county' => 'West Pokot',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Taveta',
            'county' => 'Taita-Taveta',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Narok',
            'county' => 'Narok',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ol Kalou',
            'county' => 'Nyandarua',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kakuma',
            'county' => 'Turkana',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Webuye',
            'county' => 'Bungoma',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Malaba',
            'county' => 'Busia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mbita Point',
            'county' => 'Homa Bay',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ukunda',
            'county' => 'Kwale',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Wundanyi',
            'county' => 'Taita-Taveta',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Busia',
            'county' => 'Busia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Runyenjes',
            'county' => 'Embu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Migori',
            'county' => 'Migori',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Malava',
            'county' => 'Kakamega',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Suneka',
            'county' => 'Kisii',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Embu',
            'county' => 'Embu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ogembo',
            'county' => 'Kisii',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Homa Bay',
            'county' => 'Homa Bay',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Lodwar',
            'county' => 'Turkana',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kitengela',
            'county' => 'Kajiado',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ukwala',
            'county' => 'Siaya',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Keroka',
            'county' => 'Kisii',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Meru',
            'county' => 'Meru',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Matuu',
            'county' => 'Machakos',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Oyugis',
            'county' => 'Kisumu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyahururu',
            'county' => 'Laikipia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kipkelion',
            'county' => 'Kericho',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Luanda',
            'county' => 'Vihiga',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nanyuki',
            'county' => 'Laikipia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Maua',
            'county' => 'Meru',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mtwapa',
            'county' => 'Kilifi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Isiolo',
            'county' => 'Isiolo',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Eldama Ravine',
            'county' => 'Baringo',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Voi',
            'county' => 'Taita-Taveta',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Siaya',
            'county' => 'Siaya',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyansiongo',
            'county' => 'Nyamira',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Londiani',
            'county' => 'Kericho',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Iten/Tambach',
            'county' => 'Elgeyo-Marakwet',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Chuka',
            'county' => 'Tharaka-Nithi',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Malakisi',
            'county' => 'Bungoma',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Juja',
            'county' => 'Kiambu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Ongata Rongai',
            'county' => 'Kajiado',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Bondo',
            'county' => 'Siaya',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Moyale',
            'county' => 'Marsabit',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Maralal',
            'county' => 'Samburu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Gilgil',
            'county' => 'Nakuru',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nambale',
            'county' => 'Busia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Tabaka',
            'county' => 'Kisii',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Muhoroni',
            'county' => 'Kisumu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kerugoya/Kutus',
            'county' => 'Kirinyaga',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ugunja',
            'county' => 'Siaya',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Yala',
            'county' => 'Siaya',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Rumuruti',
            'county' => 'Laikipia',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Burnt Forest',
            'county' => 'Uasin Gishu',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Maragua',
            'county' => 'Muranga',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kendu Bay',
            'county' => 'Homa Bay',
            'points' => '1',
            'created_at' => '2018-03-19 21:00:00',
            ),  


);

DB::table('towns')->insert($values);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('towns');
    }
}
