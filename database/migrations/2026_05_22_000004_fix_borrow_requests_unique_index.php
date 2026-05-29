<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // MySQL error (1553) occurs when dropping an index that is required by a foreign key.
        // The safest approach is: recreate the unique index with a different name and let the old one remain.
        // Then application logic will enforce the actual business rules.

        // Re-create the unique constraint (use a separate constraint name).
        // We avoid Blueprint::getConnection() because it doesn't exist in Laravel.
        Schema::getConnection()->statement(
            "ALTER TABLE borrow_requests ADD UNIQUE uq_student_equipment_pending (student_id, equipment_id, status)"
        );
    }

    public function down(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            $table->getConnection()->statement(
                'ALTER TABLE borrow_requests DROP INDEX uq_student_equipment_pending'
            );
        });
    }
};

