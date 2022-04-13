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
            $table->string('name');
            $table->unsignedDecimal('price', 10, 2);
            $table->decimal('discount', 4, 2)->default(0);
            $table->string('photo');
            $table->string('description', 100);
            $table->unsignedInteger('stock');
            $table->string('color', 30);
            $table->decimal('weight', 7, 2);
            $table->boolean('active')->default(true);
            $table->string('size', 20);
            $table->timestamps();
            $table->foreignId('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories');
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
