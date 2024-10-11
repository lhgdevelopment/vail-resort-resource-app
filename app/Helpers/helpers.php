<?php

use App\Models\Setting;

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
