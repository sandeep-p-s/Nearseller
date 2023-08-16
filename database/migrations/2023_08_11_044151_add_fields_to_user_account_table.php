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
        Schema::table('user_account', function (Blueprint $table) {
            $table->date('user_dob')->after('photo_file')->nullable();
            $table->string('user_house_name')->after('user_dob')->nullable();
            $table->string('user_locality')->after('user_house_name')->nullable();
            $table->string('user_city')->after('user_locality')->nullable();
            $table->string('user_country')->after('user_city')->nullable();
            $table->string('user_state')->after('user_country')->nullable();
            $table->string('user_dist')->after('user_state')->nullable();
            $table->string('user_pincode')->after('user_dist')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_account', function (Blueprint $table) {
            $table->dropColumn('user_dob');
            $table->dropColumn('user_house_name');
            $table->dropColumn('user_locality');
            $table->dropColumn('user_city');
            $table->dropColumn('user_country');
            $table->dropColumn('user_state');
            $table->dropColumn('user_dist');
            $table->dropColumn('user_pincode');


        });
    }
};
