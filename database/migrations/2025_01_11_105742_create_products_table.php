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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('subcategory_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('product_name');
            $table->foreignId('supplier')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('quantity')->constrained();
            $table->string('description');
            $table->string('short_description');
            $table->string('product_code');
            $table->string('product_stock');
            $table->string('unit_price');
            $table->string('total_price');
            $table->string('status');
            $table->string('product_image');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
