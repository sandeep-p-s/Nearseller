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
        Schema::create('add_product_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable()->index();
            $table->integer('attribute_id')->nullable()->index();
            $table->string('slug_description')->nullable();
            $table->float('offer_price')->nullable();
            $table->float('mrp_price')->nullable();
            $table->integer('attribute_stock')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_product_attributes');
    }
};
