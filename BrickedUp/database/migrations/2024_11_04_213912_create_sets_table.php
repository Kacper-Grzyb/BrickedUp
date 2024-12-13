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
            $table->string('set_number', 6);
            $table->text('set_name');
            $table->foreignId('theme_id')->constrained('themes')->onDelete('cascade');  // don't have to specify the references thingy if using foreignId
            $table->foreignId('subtheme_id')->constrained('subthemes')->onDelete('cascade'); // Some sets do not have a subtheme, then give them the id of the null subtheme
            $table->date('release_date');
            $table->date('retired_date')->nullable(); // If set was not retired yet
            $table->foreignId('availability_id')->constrained('availability')->onDelete('cascade');
            $table->smallInteger('piece_count');
            $table->tinyInteger('minifigures');
            $table->float('retail_price')->nullable(); // If set was not available for retail
            $table->float('price_change')->nullable();
            $table->text('price_median')->nullable();
            $table->timestamps();

            $table->primary('set_number');
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
