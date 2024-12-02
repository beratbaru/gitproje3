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
            $table->decimal('product_price', 10, 2); // Up to 10 digits, 2 decimal places
            $table->text('description');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
