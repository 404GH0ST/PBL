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
        if (! Schema::hasColumn('posts', 'excerpt')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->text('excerpt')->nullable()->after('slug');
            });
        }

        if (! Schema::hasColumn('posts', 'featured_image')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('featured_image')->nullable()->after('content');
            });
        }

        if (! Schema::hasColumn('posts', 'status')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->string('status')->default('draft')->after('featured_image');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('posts', 'status')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('posts', 'featured_image')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('featured_image');
            });
        }

        if (Schema::hasColumn('posts', 'excerpt')) {
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('excerpt');
            });
        }
    }
};
