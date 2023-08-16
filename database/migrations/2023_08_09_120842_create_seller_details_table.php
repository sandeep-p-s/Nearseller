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
        Schema::create('seller_details', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name', 100)->nullable();
            $table->string('owner_name', 100)->nullable();
            $table->string('shop_email', 50)->nullable();
            $table->string('shop_mobno', 10)->nullable();
            $table->string('referal_id')->nullable();
            $table->integer('busnes_type')->nullable();
            $table->integer('shop_executive')->nullable();
            $table->integer('term_condition')->nullable();
            $table->string('shop_licence', 20)->nullable();
            $table->string('shop_gstno', 20)->nullable();
            $table->string('shop_panno', 12)->nullable();
            $table->string('house_name_no')->nullable();
            $table->string('locality', 100)->nullable();
            $table->string('village', 12)->nullable();
            $table->integer('country')->nullable();
            $table->integer('state')->nullable();
            $table->integer('district')->nullable();
            $table->integer('pincode')->nullable();
            $table->longText('googlemap')->nullable();
            $table->string('shop_photo')->nullable();
            $table->date('establish_date')->nullable();
            $table->string('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_details');
    }
};
