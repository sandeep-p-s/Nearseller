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
        Schema::table('add_product_attributes', function (Blueprint $table) {
                $table->string('attribute_1')->nullable()->after('product_id');
                $table->string('attribute_2')->nullable()->after('attribute_1');
                $table->string('attribute_3')->nullable()->after('attribute_2');
                $table->string('attribute_4')->nullable()->after('attribute_3');
                $table->string('stock_status')->default('0')->nullable()->after('attribute_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_product_attributes', function (Blueprint $table) {
            $table->dropColumn('attribute_1');
            $table->dropColumn('attribute_2');
            $table->dropColumn('attribute_3');
            $table->dropColumn('attribute_4');
            $table->dropColumn('stock_status');
        });
    }
};
