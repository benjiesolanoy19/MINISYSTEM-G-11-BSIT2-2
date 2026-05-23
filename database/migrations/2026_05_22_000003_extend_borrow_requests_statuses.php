<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Extend enum values for status and add fields for claim/return workflow.
        // We re-create the enum by altering the column.
        Schema::table('borrow_requests', function (Blueprint $table) {
            // Add nullable fields (if they don't already exist)
            if (!Schema::hasColumn('borrow_requests', 'claimed_at')) {
                $table->timestamp('claimed_at')->nullable()->after('approval_date');
            }
            if (!Schema::hasColumn('borrow_requests', 'returned_at')) {
                $table->timestamp('returned_at')->nullable()->after('claimed_at');
            }
            if (!Schema::hasColumn('borrow_requests', 'remarks')) {
                $table->text('remarks')->nullable()->after('returned_at');
            }
        });

        // Alter status enum by using a raw statement (MySQL enum alteration).
        // This keeps existing rows but updates allowed values.
        Schema::connection(null)->getConnection()->statement(
            "ALTER TABLE borrow_requests MODIFY status ENUM('pending','approved','rejected','ready_to_claim','claimed','returned','overdue') NOT NULL DEFAULT 'pending'"
        );
    }

    public function down(): void
    {
        Schema::connection(null)->getConnection()->statement(
            "ALTER TABLE borrow_requests MODIFY status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending'"
        );

        Schema::table('borrow_requests', function (Blueprint $table) {
            if (Schema::hasColumn('borrow_requests', 'claimed_at')) {
                $table->dropColumn('claimed_at');
            }
            if (Schema::hasColumn('borrow_requests', 'returned_at')) {
                $table->dropColumn('returned_at');
            }
            if (Schema::hasColumn('borrow_requests', 'remarks')) {
                $table->dropColumn('remarks');
            }
        });
    }
};

