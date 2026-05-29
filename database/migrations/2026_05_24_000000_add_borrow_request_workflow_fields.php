<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('borrow_requests', 'purpose')) {
                $table->text('purpose')->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('borrow_requests', 'borrow_date')) {
                $table->date('borrow_date')->nullable()->after('request_date');
            }
            if (!Schema::hasColumn('borrow_requests', 'return_date')) {
                $table->date('return_date')->nullable()->after('borrow_date');
            }
            if (!Schema::hasColumn('borrow_requests', 'return_requested_at')) {
                $table->timestamp('return_requested_at')->nullable()->after('claimed_at');
            }
            if (!Schema::hasColumn('borrow_requests', 'notes')) {
                $table->text('notes')->nullable()->after('return_date');
            }
        });

        Schema::connection(null)->getConnection()->statement(
            "ALTER TABLE borrow_requests MODIFY status ENUM('pending','approved','rejected','ready_to_claim','claimed','return_requested','returned','overdue') NOT NULL DEFAULT 'pending'"
        );
    }

    public function down(): void
    {
        Schema::connection(null)->getConnection()->statement(
            "ALTER TABLE borrow_requests MODIFY status ENUM('pending','approved','rejected','ready_to_claim','claimed','returned','overdue') NOT NULL DEFAULT 'pending'"
        );

        Schema::table('borrow_requests', function (Blueprint $table) {
            if (Schema::hasColumn('borrow_requests', 'purpose')) {
                $table->dropColumn('purpose');
            }
            if (Schema::hasColumn('borrow_requests', 'borrow_date')) {
                $table->dropColumn('borrow_date');
            }
            if (Schema::hasColumn('borrow_requests', 'return_date')) {
                $table->dropColumn('return_date');
            }
            if (Schema::hasColumn('borrow_requests', 'return_requested_at')) {
                $table->dropColumn('return_requested_at');
            }
            if (Schema::hasColumn('borrow_requests', 'notes')) {
                $table->dropColumn('notes');
            }
        });
    }
};
