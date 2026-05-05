<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->date('borrow_date');
            $table->dateTime('time_in')->nullable();
            $table->dateTime('time_out')->nullable();
            $table->string('grading')->nullable();
            $table->date('return_date')->nullable();
            $table->enum('status', ['pending', 'approved', 'returned', 'lost', 'damaged'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
