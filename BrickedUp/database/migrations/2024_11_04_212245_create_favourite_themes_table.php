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
        Schema::create('favourite_themes', function (Blueprint $table) {
            // Define foreign keys
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');

            // Define the compound key
            $table->primary(['user_id', 'theme_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_themes');
    }
};
