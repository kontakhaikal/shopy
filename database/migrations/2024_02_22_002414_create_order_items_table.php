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
        Schema::create('order_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('price', false, true)->nullable(false);
            $table->bigInteger('quantity', false, true)->nullable(false);

            $table->ulid('product_id')->nullable(false);
            $table->foreign('product_id')->on('products')->references('id');

            $table->uuid('order_id')->nullable(false);
            $table->foreign('order_id')->on('orders')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
