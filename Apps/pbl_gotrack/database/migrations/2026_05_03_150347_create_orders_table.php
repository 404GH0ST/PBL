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
            $table->string('tracking_id')->unique(); 
            $table->string('customer_name');
            $table->string('customer_whatsapp');
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('custom_product_name')->nullable();
            $table->integer('quantity');
            $table->integer('total_price');
            $table->string('completion_proof_path')->nullable(); 
            $table->enum('status', ['processing', 'shipped', 'completed', 'cancelled'])->default('processing');
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
