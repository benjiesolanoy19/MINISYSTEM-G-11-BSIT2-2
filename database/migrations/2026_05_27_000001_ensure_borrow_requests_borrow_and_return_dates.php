<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            if (!Schema::hasColumn('borrow_requests', 'borrow_date')) {
                $table->date('borrow_date')->nullable()->after('request_date');
            }

            if (!Schema::hasColumn('borrow_requests', 'return_date')) {
                $table->date('return_date')->nullable()->after('borrow_date');
            }
        });
    }

    public function down(): void
    {
        Schema::table('borrow_requests', function (Blueprint $table) {
            if (Schema::hasColumn('borrow_requests', 'borrow_date')) {
                $table->dropColumn('borrow_date');
            }

            if (Schema::hasColumn('borrow_requests', 'return_date')) {
                $table->dropColumn('return_date');
            }
        });
    }
};

