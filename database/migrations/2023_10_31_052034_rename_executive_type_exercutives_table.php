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
        Schema::table('executives', function (Blueprint $table) {
            $table->renameColumn('executive_type', 'business_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('executives', function (Blueprint $table) {
            $table->renameColumn('business_type_id', 'executive_type');
        });
    }
};
