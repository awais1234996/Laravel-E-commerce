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
        Schema::create('pos_orderinfo', function (Blueprint $table) {
            $table->id();
            $table->string('order_by')->nullable();
            $table->string('order_product_name');
            $table->string('order_code');
            $table->string('order_unit_price');
            $table->string('order_quantity');
            $table->string('order_total_price');
            $table->string('order_email');
            $table->string('order_invoice')->nullable();
            $table->string('order_status')->nullable();
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_orderinfo');
    }
};
