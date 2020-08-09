<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('products', function (Blueprint $table) {
//            $table->id();
//            $table->string('name');
//            $table->string('description');
//            $table->string('unit');
//            $table->string('unitRate');
//            $table->string('sname');
//            $table->string('discount');
//            $table->string('new');
//            $table->string('pcat');
//            $table->string('pimg');
//            $table->string('inStock');
//            $table->string('stock');
//            $table->json('extraFields');
//            $table->boolean('status');
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
