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
            $table->string('video_name');
            $table->string('demo_video_url');
            $table->string('video_url');
            $table->string('video_upload_time');
            $table->string('video_view');
            $table->string('video_like');
            $table->string('overlay_gg');
            $table->string('video_share');
            $table->string('watermark');
            $table->timestamps();
        });


        Schema::create('lvp_categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->string('category_image');
            $table->string('status');
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
