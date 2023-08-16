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
        Schema::create('user_account', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('email', 50)->unique();
            $table->string('mobno', 10)->unique();
            $table->string('password',100);
            $table->string('user_status',1)->default('N');
            $table->string('forgot_pass',25)->nullable();
            $table->string('user_type',25);
            $table->date('active_date')->nullable();
            $table->string('approved',1)->default('N');
            $table->string('approved_by')->nullable();
            $table->dateTime('approved_at')->nullable();
            $table->string('ip')->nullable();
            $table->string('parent_id',25)->nullable();
            $table->string('email_verify',1)->default('N');
            $table->string('mobile_verify',1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_account');
    }
};
