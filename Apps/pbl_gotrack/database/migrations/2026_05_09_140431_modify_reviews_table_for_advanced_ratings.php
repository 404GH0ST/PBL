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
        Schema::table('reviews', function (Blueprint $table) {

            $table->foreignId('product_id')->nullable()->after('order_id')->constrained('products')->onDelete('cascade');
            $table->integer('product_rating')->after('product_id')->comment('1-5 Bintang Kualitas Produk');
            $table->integer('service_rating')->after('product_rating')->comment('1-5 Bintang Pelayanan Admin');
            $table->boolean('is_visible')->default(false)->after('comment');
            $table->dropColumn('rating');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropColumn(['product_id', 'product_rating', 'service_rating', 'is_visible']);
            $table->integer('rating')->default(0);
        });
    }
};
