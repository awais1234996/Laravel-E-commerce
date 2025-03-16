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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("role_name");
            $table->string("role_access");
            $table->string("category")->nullable();
            $table->string("subcategory")->nullable();
            $table->string("supplier")->nullable();
            $table->string("quantity")->nullable();
            $table->string("products")->nullable();
            $table->string("orders")->nullable();
            $table->string("pos")->nullable();
            $table->string("user_management")->nullable();
            $table->string("contact")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
