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
        Schema::table('user_pages', function (Blueprint $table) {
            $table->string('privilage', 5)->nullable()->comment('A-All Privilages,V-View Only')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_pages', function (Blueprint $table) {
            $table->string('privilage', 2)->nullable()->comment('A-All Privilages,V-View Only')->change();
        });
    }
};
