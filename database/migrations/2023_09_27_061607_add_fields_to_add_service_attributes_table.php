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
        Schema::table('add_service_attributes', function (Blueprint $table) {
            $table->float('offer_price')->nullable()->after('attribute_4');
            $table->float('mrp_price')->nullable()->after('offer_price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_service_attributes', function (Blueprint $table) {
            $table->dropColumn('offer_price');
            $table->dropColumn('mrp_price');
        });
    }
};
