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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobno', 10)->unique()->after('email');
            $table->string('user_status',1)->default('N')->after('remember_token');
            $table->string('forgot_pass',25)->nullable()->after('user_status');
            $table->string('role_id',25)->after('forgot_pass')->nullable();
            $table->date('active_date')->nullable()->after('role_id');
            $table->string('approved',1)->default('N')->after('active_date');
            $table->string('approved_by')->nullable()->after('approved');
            $table->dateTime('approved_at')->nullable()->after('approved_by');
            $table->string('ip')->nullable()->after('approved_at');
            $table->string('parent_id',25)->nullable()->after('ip');
            $table->string('email_verify',1)->default('N')->after('parent_id');
            $table->string('mobile_verify',1)->default('N')->after('email_verify');
            $table->string('referal_id')->after('mobile_verify')->nullable();
            $table->string('photo_file')->after('referal_id')->nullable();
            $table->date('user_dob')->after('photo_file')->nullable();
            $table->string('user_house_name')->after('user_dob')->nullable();
            $table->string('user_locality')->after('user_house_name')->nullable();
            $table->string('user_city')->after('user_locality')->nullable();
            $table->string('user_country')->after('user_city')->nullable();
            $table->string('user_state')->after('user_country')->nullable();
            $table->string('user_dist')->after('user_state')->nullable();
            $table->string('user_pincode')->after('user_dist')->nullable();
            $table->string('mob_countrycode',5)->after('user_pincode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobno');
            $table->dropColumn('user_status');
            $table->dropColumn('forgot_pass');
            $table->dropColumn('role_id');
            $table->dropColumn('active_date');
            $table->dropColumn('approved');
            $table->dropColumn('approved_by');
            $table->dropColumn('approved_at');
            $table->dropColumn('ip');
            $table->dropColumn('parent_id');
            $table->dropColumn('email_verify');
            $table->dropColumn('mobile_verify');
            $table->dropColumn('referal_id');
            $table->dropColumn('photo_file');
            $table->dropColumn('user_dob');
            $table->dropColumn('user_house_name');
            $table->dropColumn('user_locality');
            $table->dropColumn('user_city');
            $table->dropColumn('user_country');
            $table->dropColumn('user_state');
            $table->dropColumn('user_dist');
            $table->dropColumn('user_pincode');
            $table->dropColumn('mob_countrycode');
        });
    }
};
