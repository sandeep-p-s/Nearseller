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
            $table->string('show_status')->default('0')->nullable()->after('attribute_4');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('add_service_attributes', function (Blueprint $table) {
            $table->dropColumn('show_status');
        });
    }
};
