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
            $table->enum('gender', ['male', 'female'])->after('dob')->nullable();
            $table->string('profession')->after('gender')->nullable();
            $table->string('marital_status')->after('profession')->nullable();
            $table->string('religion')->after('marital_status')->nullable();
            $table->string('passbook_file')->after('aadhar_file')->nullable();
            $table->string('photo_file')->after('passbook_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('profession');
            $table->dropColumn('marital_status');
            $table->dropColumn('religion');
            $table->dropColumn('passbook_file');
            $table->dropColumn('photo_file');
        });
    }
};
