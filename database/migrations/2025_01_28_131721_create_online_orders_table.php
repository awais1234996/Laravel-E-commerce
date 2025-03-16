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
        Schema::create('online_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_name');
            $table->string('order_code');
            $table->string('order_price');
            $table->string('order_quantity');
            $table->string('order_total_price');
            $table->string('order_email');
            $table->string('order_image');
            $table->string('order_invoice');
            $table->string('order_status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('online_orders');
    }
};
