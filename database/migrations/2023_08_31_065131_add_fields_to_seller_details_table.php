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
            $table->string('open_close_time')->after('establish_date')->nullable();
            $table->date('registration_date')->after('open_close_time')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('seller_details', function (Blueprint $table) {
            $table->dropColumn('open_close_time');
            $table->dropColumn('registration_date');
        });
    }
};
