<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lvp_videos', function (Blueprint $table) {
            $table->id();
            $table->integer('cat_id');
            $table->string('title');
            $table->string('height');
            $table->string('width');
            $table->string('zip');
            $table->string('is_hot');
            $table->longText('video_url');
            $table->longText('thumb_url');
            $table->longText('zip_url');
            $table->boolean('is_new')->default(false);
            $table->timestamps();
        });


        Schema::create('lvp_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sort_by');
            $table->longText('image_url');
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
        Schema::dropIfExists('lvp_categories');
        Schema::dropIfExists('lvp_videos');
    }
}
