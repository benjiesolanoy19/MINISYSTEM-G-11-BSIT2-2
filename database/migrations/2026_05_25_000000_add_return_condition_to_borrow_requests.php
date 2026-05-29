<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('borrow_requests', 'return_condition')) {
                $table->enum('return_condition', ['good', 'minor_damage', 'major_damage'])
                      ->nullable()
                      ->after('returned_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            if (Schema::hasColumn('borrow_requests', 'return_condition')) {
                $table->dropColumn('return_condition');
            }
        });
    }
};
