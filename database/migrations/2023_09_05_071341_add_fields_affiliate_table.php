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
        Schema::table('affiliate', function (Blueprint $table) {
            $table->string('account_holder_name')->after('aff_coordinator');
            $table->integer('account_no')->after('aff_coordinator')->after('account_holder_name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate', function (Blueprint $table) {
            $table->dropColumn('account_holder_name');
            $table->dropColumn('account_no');
        });
    }
};
