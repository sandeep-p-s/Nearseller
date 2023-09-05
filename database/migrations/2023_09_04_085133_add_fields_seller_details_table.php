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
            $table->string('direct_affiliate')->after('registration_date')->nullable();
            $table->string('second_affiliate')->after('direct_affiliate')->nullable();
            $table->string('shop_coordinator')->after('second_affiliate')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->dropColumn('direct_affiliate');
            $table->dropColumn('second_affiliate');
            $table->dropColumn('shop_coordinator');
        });
    }
};
