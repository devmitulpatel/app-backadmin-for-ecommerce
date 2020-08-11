<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra__fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('dname')->default("");
            $table->string('cat')->default('0');
            $table->string('scat')->default('0');
            $table->string('type')->default('text');
            $table->string('dvalue')->default("");
            $table->boolean('required')->default(0);
            $table->boolean('status')->default(1);

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
        Schema::dropIfExists('extra__fields');
    }
}
