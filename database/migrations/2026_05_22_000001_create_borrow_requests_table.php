<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrow_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained('equipment')->onDelete('cascade');

            $table->integer('quantity');

            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamp('request_date')->useCurrent();

            $table->timestamp('approval_date')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

            $table->timestamps();

            $table->unique(['student_id', 'equipment_id', 'status'], 'uq_student_equipment_status');
            // Note: prevents same equipment twice *with same status*.
            // Business rule below is stricter (only one pending). We'll enforce in app logic.
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrow_requests');
    }
};

