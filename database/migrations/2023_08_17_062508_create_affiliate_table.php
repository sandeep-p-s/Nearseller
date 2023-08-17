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
        Schema::create('affiliate', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mob_no')->nullable();
            $table->date('dob')->nullable();
            $table->string('referal_id')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('locality')->nullable();
            $table->integer('country')->nullable();
            $table->integer('state')->nullable();
            $table->integer('district')->nullable();
            $table->string('aadhar_file')->nullable();
            $table->boolean('t&c');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate');
    }
};
