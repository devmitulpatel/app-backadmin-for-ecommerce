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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->nullable();
            $table->string('name');
            $table->string('sname')->nullable();
            $table->string('version')->nullable();
            $table->longText('pimg')->nullable();
            $table->longText('pimgs')->nullable();
            $table->longText('description')->default('')->nullable();
            $table->integer('cat')->default(0);
            $table->integer('scat')->default(0);
            $table->integer('unit')->default(0);
            $table->integer('urate')->default(0);
            $table->boolean('keepStock')->default(0);
            $table->integer('ostock')->default(0)->nullable();
            $table->boolean('feature')->default(0);
            $table->boolean('new')->default(0);
            $table->json('extraFields')->nullable();
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
        Schema::dropIfExists('products');
    }
}
