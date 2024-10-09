<?php

use App\Models\Setting;
use App\Models\User;
use App\Models\Category;
use App\Models\Resource;
use App\Models\ResourceFile;

/**
 * Retrieve a setting value by key.
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
if (!function_exists('settings')) {
    function settings(string $key, $default = null)
    {
        // Static variable to hold settings
        static $settings = null;

        // Load settings once
        if ($settings === null) {
            // Assuming you have only one settings row
            $settingsRow = Setting::first();

            if ($settingsRow) {
                // Convert settings to an associative array
                $settings = $settingsRow->toArray();
            } else {
                $settings = [];
            }
        }

        // Return the setting value if it exists, else default
        return $settings[$key] ?? $default;
    }
}


if (!function_exists('tcount')) {
    function tcount()
    {
        $totalUsers = User::count();
        $totalCategories = Category::count();
        $totalVideos = ResourceFile::where('resource_type', 'embed_code')->count();
        $totalDocuments = ResourceFile::where('resource_type', 'file')->count();

        return [
            'total_users' => $totalUsers,
            'total_categories' => $totalCategories,
            'total_videos' => $totalVideos,
            'total_documents' => $totalDocuments,
        ];
    }
}

if (!function_exists('ltoMonths')) {
    function ltoMonths()
    {
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        return $months;
    }
}
