<?php

use Illuminate\Support\Facades\Artisan;

// Create storage symlink if it doesn't exist
if (!file_exists(public_path('storage'))) {
    try {
        Artisan::call('storage:link');
        echo "Storage symlink created successfully.\n";
    } catch (\Exception $e) {
        echo "Error creating storage symlink: " . $e->getMessage() . "\n";
    }
}
