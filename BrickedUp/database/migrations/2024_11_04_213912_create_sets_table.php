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
        Schema::create('sets', function (Blueprint $table) {
            $table->string('set_number', length: 6)->primary();
            $table->text('set_name');
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');  // don't have to specify the references thingy if using foreignId
            $table->foreignId('subtheme_id')->constrained()->onDelete('cascade'); // Some sets do not have a subtheme, then give them the id of the null subtheme
            $table->date('release_date');
            $table->date('retired_date')->nullable(); // If set was not retired yet
            $table->INTEGER('availability_id')->references('id')->on('availability')->constrained()->onDelete('cascade');
            $table->smallInteger('piece_count');
            $table->tinyInteger('minifigures');
            $table->float('retail_price')->nullable(); // If set was not available for retail
            $table->tinyInteger('popularity')->nullable(); // This is for a potential recommendation system later on
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};
