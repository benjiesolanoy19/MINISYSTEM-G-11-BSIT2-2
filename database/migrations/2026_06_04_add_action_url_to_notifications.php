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
        Schema::table('notifications', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('notifications', 'action_url')) {
                $table->string('action_url')->nullable()->after('type');
            }
            if (!Schema::hasColumn('notifications', 'reference_id')) {
                $table->integer('reference_id')->nullable()->after('action_url');
            }
            if (!Schema::hasColumn('notifications', 'reference_type')) {
                $table->string('reference_type')->nullable()->after('reference_id');
            }
            if (!Schema::hasColumn('notifications', 'title')) {
                $table->string('title')->nullable()->after('message');
            }
            if (!Schema::hasColumn('notifications', 'icon')) {
                $table->string('icon')->default('fa-info-circle')->after('title');
            }
            if (!Schema::hasColumn('notifications', 'read_at')) {
                $table->timestamp('read_at')->nullable()->after('is_read');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn([
                'action_url',
                'reference_id',
                'reference_type',
                'title',
                'icon',
                'read_at'
            ]);
        });
    }
};
