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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('product_name', 100)->nullable();
            $table->longText('product_specification')->nullable();
            $table->string('category_id', 10)->nullable();
            $table->longText('product_description')->nullable();
            $table->longText('product_images')->nullable();
            $table->longText('product_videos')->nullable();
            $table->longText('product_document')->nullable();
            $table->longText('manufacture_details')->nullable();
            $table->string('brand_name', 100)->nullable();
            $table->string('paying_mode', 10)->nullable();
            $table->string('product_stock', 12)->nullable();
            $table->string('is_attribute',10)->nullable();
            $table->string('created_by')->nullable();
            $table->timestamp('created_time')->nullable();
            $table->string('product_status')->default('Y')->nullable();
            $table->string('is_approved',1)->default('N')->nullable();
            $table->string('approved_by',10)->nullable();
            $table->timestamp('approved_time')->nullable();
            $table->timestamps();
            $table->index(['product_name', 'category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
