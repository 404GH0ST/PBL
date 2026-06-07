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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_type')->default('dp')->after('total_price');
            $table->integer('paid_amount')->default(0)->after('dp_amount');
            $table->timestamp('paid_at')->nullable()->after('paid_amount');
        });

        \Illuminate\Support\Facades\DB::table('orders')
            ->where('payment_status', 'paid')
            ->update([
                'payment_type' => 'paid',
                'paid_amount' => \Illuminate\Support\Facades\DB::raw('total_price'),
            ]);

        \Illuminate\Support\Facades\DB::table('orders')
            ->where('payment_status', 'dp')
            ->update([
                'payment_type' => 'dp',
                'paid_amount' => \Illuminate\Support\Facades\DB::raw('COALESCE(dp_amount, 0)'),
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_type',
                'paid_amount',
                'paid_at',
            ]);
        });
    }
};
