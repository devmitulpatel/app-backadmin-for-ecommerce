<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {


//
//        "clientData" => array:14 [▼
//    "status" => "success"
//    "country" => "India"
//    "countryCode" => "IN"
//    "region" => "GJ"
//    "regionName" => "Gujarat"
//    "city" => "Surat"
//    "zip" => "395007"
//    "lat" => 21.1959
//    "lon" => 72.8302
//    "timezone" => "Asia/Kolkata"
//    "isp" => "Gujarat Telelink Pvt Ltd"
//    "org" => "Gtpl Broadband Pvt. Ltd."
//    "as" => "AS45916 Gujarat Telelink Pvt Ltd"
//    "query" => "103.240.79.62"
//  ]
//  "clientIp" => "103.240.79.62"
//



        Schema::create('chat_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('countryCode');
            $table->string('region');
            $table->string('city');
            $table->string('zip');
            $table->string('lat');
            $table->string('lon');
            $table->string('timezone');
            $table->string('isp');
            $table->string('org');
            $table->string('ip');
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
        Schema::dropIfExists('chat_sessions');
    }
}
