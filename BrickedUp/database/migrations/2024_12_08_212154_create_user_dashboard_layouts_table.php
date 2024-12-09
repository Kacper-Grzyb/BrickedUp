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
        Schema::create('user_dashboard_layouts', function (Blueprint $table) {
            // Define foreign keys
            $table->foreignId('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->foreignId('element_id')->references('id')->on('dashboard_elements')->constrained()->onDelete('cascade');
            $table->string('style', length: 200);

            // Set the primary key
            $table->primary(['user_id', 'element_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_dashboard_layouts');
    }
};
