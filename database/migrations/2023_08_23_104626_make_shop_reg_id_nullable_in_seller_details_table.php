<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\ChangeColumn;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->string('shop_reg_id')->nullable()->change();
            $table->string('affiliate_reg_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->string('shop_reg_id')->nullable(false)->change();
            $table->string('affiliate_reg_id')->nullable(false)->change();
        });
    }
};
