<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionsTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions_takens', function (Blueprint $table) {
            $table->id();
            $table->integer('type');
            $table->string('table');
            $table->string('connection');
            $table->string('model');
            $table->string('prefix');
            $table->string('callByFunction');
            $table->string('takenById');
            $table->integer('count');
            $table->longText('whereData');
            $table->longText('data');
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
        Schema::dropIfExists('actions_takens');
    }
}
