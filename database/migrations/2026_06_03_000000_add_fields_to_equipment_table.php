<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->string('asset_tag')->nullable()->after('id');
            $table->string('brand')->nullable()->after('category');
            $table->string('model')->nullable()->after('brand');
            $table->string('location')->nullable()->after('serial_number');
            $table->string('assigned_to')->nullable()->after('location');
            $table->date('purchase_date')->nullable()->after('assigned_to');
            $table->date('warranty_expiration')->nullable()->after('purchase_date');
            $table->enum('condition', ['Good', 'Fair', 'Poor'])->default('Good')->after('warranty_expiration');
            $table->string('image_path')->nullable()->after('description');
            $table->string('status_label')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropColumn([
                'asset_tag', 'brand', 'model', 'location', 'assigned_to', 'purchase_date', 'warranty_expiration', 'condition', 'image_path', 'status_label'
            ]);
        });
    }
};
