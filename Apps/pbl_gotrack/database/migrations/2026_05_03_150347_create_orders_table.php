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
            $table->string('tracking_id')->unique(); // Ini yang sebelumnya kita sebut order_number
            $table->string('customer_name');
            $table->string('customer_whatsapp'); // Wajib diisi
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('custom_product_name')->nullable();

            // Kolom Fitur Variasi Dinamis (Addons)
            $table->json('selected_addons')->nullable();

            $table->integer('quantity');
            $table->integer('total_price');

            // Kolom Fitur Pembayaran
            $table->string('payment_status')->default('unpaid');
            $table->integer('dp_amount')->nullable();

            // Kolom Catatan Kasir (Penting untuk bisnis cetak)
            $table->text('notes')->nullable();

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
