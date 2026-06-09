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
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon_slug')->nullable();   // e.g. "laravel", "vuejs" for devicon
            $table->string('category')->nullable();    // e.g. "backend", "frontend", "devops"
            $table->string('color_hex', 7)->nullable(); // e.g. "#FF2D20"
            $table->string('icon_link')->nullable(); // e.g. "#FF2D20"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technologies');
    }
};
