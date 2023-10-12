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
        Schema::table('open_close_day_times', function (Blueprint $table) {
            $table->renameColumn('user_id', 'seller_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('open_close_day_times', function (Blueprint $table) {
            $table->renameColumn('seller_id', 'user_id');
        });
    }
};
