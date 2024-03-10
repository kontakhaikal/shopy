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
        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name')->nullable(false);
            $table->bigInteger('cost')->nullable(false);

            $table->uuid('shipping_option_id')->nullable(false);
            $table->foreign('shipping_option_id')->on('shipping_options')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};
