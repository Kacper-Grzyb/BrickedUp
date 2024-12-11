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
        Schema::create('set_images', function (Blueprint $table) {
            $table->string('set_number', 6);
            $table->foreign('set_number')->references('set_number')->on('sets')->onDelete('cascade');
            $table->binary('image_data');

            // No primary key
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('set_images');
    }
};
