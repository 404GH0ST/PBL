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
        Schema::table('order_progress', function (Blueprint $table) {
            // Cek dan buat kolom production_stage_id jika belum ada
            if (!Schema::hasColumn('order_progress', 'production_stage_id')) {
                $table->foreignId('production_stage_id')->constrained('production_stages')->cascadeOnDelete();
            }

            // Cek dan buat kolom notes karena ternyata sebelumnya belum ada
            if (!Schema::hasColumn('order_progress', 'notes')) {
                $table->text('notes')->nullable();
            }

            // Cek dan buat kolom photo
            if (!Schema::hasColumn('order_progress', 'photo')) {
                $table->string('photo')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_progress', function (Blueprint $table) {
            if (Schema::hasColumn('order_progress', 'production_stage_id')) {
                $table->dropForeign(['production_stage_id']);
                $table->dropColumn('production_stage_id');
            }
            if (Schema::hasColumn('order_progress', 'notes')) {
                $table->dropColumn('notes');
            }
            if (Schema::hasColumn('order_progress', 'photo')) {
                $table->dropColumn('photo');
            }
        });
    }
};
