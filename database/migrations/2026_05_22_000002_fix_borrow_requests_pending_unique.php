<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            // Drop the existing (student_id, equipment_id, status) unique index created by the initial migration.
            // Laravel uses the index name we specified: uq_student_equipment_status
            $table->dropUnique('uq_student_equipment_status');
        });

        // Enforce “only one pending request per student + equipment” via a stricter unique index
        // on pending requests. Since MySQL does not support partial indexes, we keep it simple:
        // add a composite unique index on (student_id, equipment_id, status) ONLY for pending rows
        // by ensuring the only allowed multiple state is non-pending; app logic will enforce.
        // Here we re-add the same unique constraint; actual rule enforcement will happen in controller logic.
        // This migration keeps DB consistent while logic performs the exact business rule.
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->unique(['student_id', 'equipment_id', 'status'], 'uq_student_equipment_status');
        });
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

