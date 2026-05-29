<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the existing unique index if possible.
        // MySQL may refuse dropping when the index is needed for a foreign-key constraint.
        // In that case, we skip dropping to keep migrations idempotent.
        try {
            Schema::table('borrow_requests', function (Blueprint $table) {
                $table->dropUnique('uq_student_equipment_status');
            });
        } catch (\Throwable $e) {
            // no-op
        }

        // Re-add the same unique constraint (if it doesn’t already exist).
        try {
            Schema::table('borrow_requests', function (Blueprint $table) {
                $table->unique(['student_id', 'equipment_id', 'status'], 'uq_student_equipment_status');
            });
        } catch (\Throwable $e) {
            // no-op
        }
    }

    public function down(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->dropUnique('uq_student_equipment_status');
        });

        // Restore previous state: same unique constraint
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->unique(['student_id', 'equipment_id', 'status'], 'uq_student_equipment_status');
        });
    }
};

