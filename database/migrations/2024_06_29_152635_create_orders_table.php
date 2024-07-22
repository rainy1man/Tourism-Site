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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('trip_id')->constrained();
            $table->integer('price');
            $table->integer('people_number');
            $table->enum('order_status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->enum('payment_status', ['paid', 'unpaid']);
            $table->enum('refund_status', ['not_requested', 'requested', 'processed'])->default('not_requested');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
