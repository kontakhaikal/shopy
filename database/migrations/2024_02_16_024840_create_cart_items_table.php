<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->integer('quantity', false, true);
            $table->boolean('selected')->nullable(false)->default(false);

            $table->uuid('cart_id')->nullable(false);
            $table->foreign('cart_id')->on('carts')->references('id');

            $table->ulid('product_id')->nullable(false);
            $table->foreign('product_id')->on('products')->references('id');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
