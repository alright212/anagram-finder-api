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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('original_word', 255)->unique();
            $table->string('canonical_form', 255)->index(); // Critical for anagram lookup performance
            $table->unsignedSmallInteger('length')->index(); // Useful for optimizations
            $table->timestamps();
            
            // Additional composite index for better performance
            $table->index(['canonical_form', 'original_word']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
