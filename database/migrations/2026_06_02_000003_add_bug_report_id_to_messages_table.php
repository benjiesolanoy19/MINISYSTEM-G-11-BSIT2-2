<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // The column is already created in 2026_06_02_000002_create_messages_table.
        // This migration must be idempotent to support fresh/repeated installs.
        if (Schema::hasColumn('messages', 'bug_report_id')) {
            return;
        }

        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('bug_report_id')
                ->nullable()
                ->constrained('bug_reports')
                ->nullOnDelete()
                ->after('receiver_id');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            if (Schema::hasColumn('messages', 'bug_report_id')) {
                // dropForeign will fail if the constraint doesn't exist, so guard it by attempting only.
                // Laravel does not provide a direct hasForeignConstraint helper; this pattern keeps it safe.
                $table->dropForeign(['bug_report_id']);
                $table->dropColumn('bug_report_id');
            }
        });
    }
};

