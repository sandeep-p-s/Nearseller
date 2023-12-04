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
            $table->string('shoplogo')->after('updated_at')->nullable()->index();
            $table->string('colorpicks')->after('shoplogo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->dropColumn('shoplogo');
            $table->dropColumn('colorpicks');
        });
    }
};
