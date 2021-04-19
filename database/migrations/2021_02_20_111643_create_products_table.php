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
            $table->timestamps();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->string('status');
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('srp');
            $table->integer('quantity');
            $table->integer('warranty');
            $table->integer('delivery_fee');
            $table->boolean('availability');
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
