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
            $table->integer('bank_country')->nullable()->after('aff_coordinator');
            $table->integer('bank_state')->nullable()->after('bank_country');
            $table->integer('bank_dist')->nullable()->after('bank_state');
            $table->integer('bank_type')->nullable()->after('bank_dist');
            $table->integer('branch_code')->nullable()->after('bank_type');
            $table->string('pan_no')->nullable()->after('terms_condition');
            $table->integer('registration_date')->nullable()->after('pan_no');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate', function (Blueprint $table) {
            $table->dropColumn('bank_country');
            $table->dropColumn('bank_state');
            $table->dropColumn('bank_dist');
            $table->dropColumn('bank_type');
            $table->dropColumn('branch_code');
            $table->dropColumn('pan_no');
            $table->dropColumn('registration_date');
        });
    }
};
