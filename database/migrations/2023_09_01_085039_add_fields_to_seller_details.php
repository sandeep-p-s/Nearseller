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
            $table->longText('socialmedia')->after('pincode')->nullable();
            $table->longText('manufactoring_details')->after('socialmedia')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->dropColumn('social_media');
            $table->dropColumn('manufactoring_details');
        });
    }
};
