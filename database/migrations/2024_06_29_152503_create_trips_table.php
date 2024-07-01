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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained();
            $table->integer('price');
            $table->integer('capacity');
            $table->time('start_at');
            $table->time('end_at');
            $table->enum('meal', ['BB', 'HB', 'FB', 'AI']);
            $table->enum('transport', ['train', 'bus', 'airplane']);
            $table->enum('stay_class', ['economy', 'business', 'first_class']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
