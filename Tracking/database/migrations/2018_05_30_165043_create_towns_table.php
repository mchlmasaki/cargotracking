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
            $table->timestamps();
        });
                //insert default Admin
        $values = array(
            array(
            'town' => 'Nairobi',
            'county' => 'Nairobi',
            'created_at' => '2018-03-19 21:00:00',
            ),
        
array(
            'town' => 'Mombasa',
            'county' => 'Mombasa',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kisumu',
            'county' => 'Kisumu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nakuru',
            'county' => 'Nakuru',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Eldoret',
            'county' => 'Uasin Gishu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kehancha Munici',
            'county' => 'Migori',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ruiru',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kikuyu',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kangundo-Tala',
            'county' => 'Machakos',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Malindi',
            'county' => 'Kilifi',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Naivasha',
            'county' => 'Nakuru',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kitui',
            'county' => 'Kitui',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Machakos',
            'county' => 'Machakos',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Thika',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Athi River/Mavoko',
            'county' => 'Machakos',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Karuri',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyeri',
            'county' => 'Nyeri',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kilifi',
            'county' => 'Kilifi',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Garissa',
            'county' => 'Garissa',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Vihiga',
            'county' => 'Vihiga',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Mumias',
            'county' => 'Kakamega',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Bomet',
            'county' => 'Bomet',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Molo',
            'county' => 'Nakuru',
            'created_at' => '2018-03-19 21:00:00',
            ),      
array(
            'town' => 'Ngong',
            'county' => 'Kajiado',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kitale',
            'county' => 'Trans-Nzoia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Litein',
            'county' => 'Kericho',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Limuru',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kericho',
            'county' => 'Kericho',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kimilili',
            'county' => 'Bungoma',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Awasi',
            'county' => 'Kisumu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kakamega',
            'county' => 'Kakamega',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kapsabet',
            'county' => 'Nandi',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mariakani',
            'county' => 'Kilifi',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kiambu',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mandera',
            'county' => 'Mandera',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyamira',
            'county' => 'Nyamira',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mwingi',
            'county' => 'Kitui',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kisii',
            'county' => 'Kisii',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Wajir',
            'county' => 'Wajir',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Rongo',
            'county' => 'Migori',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Bungoma',
            'county' => 'Bungoma',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ahero',
            'county' => 'Kisumu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
    
array(
            'town' => 'Makuyu',
            'county' => 'Muranga',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kapenguria',
            'county' => 'West Pokot',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Taveta',
            'county' => 'Taita-Taveta',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Narok',
            'county' => 'Narok',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ol Kalou',
            'county' => 'Nyandarua',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kakuma',
            'county' => 'Turkana',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Webuye',
            'county' => 'Bungoma',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Malaba',
            'county' => 'Busia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mbita Point',
            'county' => 'Homa Bay',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ukunda',
            'county' => 'Kwale',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Wundanyi',
            'county' => 'Taita-Taveta',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Busia',
            'county' => 'Busia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Runyenjes',
            'county' => 'Embu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Migori',
            'county' => 'Migori',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Malava',
            'county' => 'Kakamega',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Suneka',
            'county' => 'Kisii',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Embu',
            'county' => 'Embu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ogembo',
            'county' => 'Kisii',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Homa Bay',
            'county' => 'Homa Bay',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Lodwar',
            'county' => 'Turkana',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kitengela',
            'county' => 'Kajiado',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ukwala',
            'county' => 'Siaya',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Keroka',
            'county' => 'Kisii',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Meru',
            'county' => 'Meru',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Matuu',
            'county' => 'Machakos',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Oyugis',
            'county' => 'Kisumu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyahururu',
            'county' => 'Laikipia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kipkelion',
            'county' => 'Kericho',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Luanda',
            'county' => 'Vihiga',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nanyuki',
            'county' => 'Laikipia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Maua',
            'county' => 'Meru',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Mtwapa',
            'county' => 'Kilifi',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Isiolo',
            'county' => 'Isiolo',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Eldama Ravine',
            'county' => 'Baringo',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Voi',
            'county' => 'Taita-Taveta',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Siaya',
            'county' => 'Siaya',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nyansiongo',
            'county' => 'Nyamira',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Londiani',
            'county' => 'Kericho',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Iten/Tambach',
            'county' => 'Elgeyo-Marakwet',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Chuka',
            'county' => 'Tharaka-Nithi',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Malakisi',
            'county' => 'Bungoma',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Juja',
            'county' => 'Kiambu',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Ongata Rongai',
            'county' => 'Kajiado',
            'created_at' => '2018-03-19 21:00:00',
            ),
array(
            'town' => 'Bondo',
            'county' => 'Siaya',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Moyale',
            'county' => 'Marsabit',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Maralal',
            'county' => 'Samburu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Gilgil',
            'county' => 'Nakuru',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Nambale',
            'county' => 'Busia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Tabaka',
            'county' => 'Kisii',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Muhoroni',
            'county' => 'Kisumu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kerugoya/Kutus',
            'county' => 'Kirinyaga',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Ugunja',
            'county' => 'Siaya',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Yala',
            'county' => 'Siaya',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Rumuruti',
            'county' => 'Laikipia',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Burnt Forest',
            'county' => 'Uasin Gishu',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Maragua',
            'county' => 'Muranga',
            'created_at' => '2018-03-19 21:00:00',
            ),  
array(
            'town' => 'Kendu Bay',
            'county' => 'Homa Bay',
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
