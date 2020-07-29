<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings_generals', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyName');
            $table->longText('websiteLogo');
            $table->longText('invoiceLogo');
            $table->longText('PrivatePolicy')->nullable();
            $table->longText('AboutUs')->nullable();
            $table->longText('ContcatUs')->nullable();
            $table->longText('TermNCondition')->nullable();
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
        Schema::dropIfExists('settings_generals');
    }
}
