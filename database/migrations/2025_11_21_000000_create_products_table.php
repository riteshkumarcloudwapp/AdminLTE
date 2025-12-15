<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // $table->string('sku')->nullable();
            $table->text('description')->nullable();
            $table->decimal('actual_price', 10, 2)->default(0);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->text('image')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('tags')->nullable();
            $table->boolean('status')->default(true); 
            $table->timestamps();
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
