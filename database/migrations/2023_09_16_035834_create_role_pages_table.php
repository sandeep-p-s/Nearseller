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
        Schema::create('role_pages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->nullable();
            $table->bigInteger('menu_id')->nullable();
            $table->string('privilage', 2)->nullable()->comment('A-All Privilages,V-View Only');
            $table->string('updated_by', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_pages');
    }
};
