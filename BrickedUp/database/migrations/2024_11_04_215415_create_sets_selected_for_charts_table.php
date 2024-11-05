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
        Schema::create('sets_selected_for_charts', function (Blueprint $table) {
            // Define foreign keys
            $table->foreign('chart_id')->references('id')->on('charts')->constrained()->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->string('set_number', length: 6)-references('set_number')->on('sets')->constrained()->onDelete('cascade');

            // Set the primary key
            $table->primary(['chart_id', 'user_id', 'set_number']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets_selected_for_charts');
    }
};
