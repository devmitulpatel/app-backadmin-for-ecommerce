<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideoappAlltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(checkCurrentApp('videoapp')) {
            Schema::create('frame_master', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('imageUrl');
                $table->string('thumbUrl');
                $table->boolean('status');
                $table->timestamps();
            });

            Schema::create('image_master', function (Blueprint $table) {
                $table->id();
                $table->string('thumbUrl');
                $table->boolean('status');
                $table->timestamps();
            });

            Schema::create('sticker_master', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('thumbUrl');
                $table->boolean('status');
                $table->timestamps();
            });

            Schema::create('ringtone_master', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('thumbUrl')->nullable();
                $table->string('type')->nullable();
                $table->integer('catId');
                $table->string('mp3Url');
                $table->boolean('status');
                $table->timestamps();
            });

            Schema::create('ringtone_cat_master', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('icon');
                $table->integer('sortno');
                $table->boolean('status');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if(checkCurrentApp('videoapp')) {
            Schema::dropIfExists('frame_master');
            Schema::dropIfExists('image_master');
            Schema::dropIfExists('sticker_master');
            Schema::dropIfExists('ringtone_master');
            Schema::dropIfExists('ringtone_cat_master');
        }
    }
}
