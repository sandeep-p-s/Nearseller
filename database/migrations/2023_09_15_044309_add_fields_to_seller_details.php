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
        Schema::table('seller_details', function (Blueprint $table) {
            $table->integer('shop_type')->after('shop_service_type')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->dropColumn('shop_type');
        });
    }
};
