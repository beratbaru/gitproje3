<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->bigInteger('product_price'); // 10 digits, no decimals
            $table->text('description');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
