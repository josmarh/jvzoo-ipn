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
        Schema::create('jv_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique();
            $table->string('product_name');
            $table->string('access_level')->nullable();
            $table->timestamps();
        });

        Schema::create('jv_product_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('transaction_id')->unique();
            $table->string('transaction_type')->nullable();
            $table->string('customer_email');
            $table->string('customer_name')->nullable();
            $table->string('amount');
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index('product_id');
            $table->foreign('product_id')->references('product_id')->on('jv_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jv_product_transactions');
        Schema::dropIfExists('jv_products');
    }
};