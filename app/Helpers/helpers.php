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

/**
 * Configure mail settings with custom SMTP from database
 */
if (!function_exists('configureCustomMailSettings')) {
    function configureCustomMailSettings()
    {
        try {
            $smtpSettings = \App\Models\SMTPSetting::first();
            
            if ($smtpSettings) {
                // Configure mailer with custom SMTP settings
                config([
                    'mail.mailers.smtp.host' => $smtpSettings->mail_host,
                    'mail.mailers.smtp.port' => $smtpSettings->mail_port,
                    'mail.mailers.smtp.username' => $smtpSettings->mail_username,
                    'mail.mailers.smtp.password' => $smtpSettings->mail_password,
                    'mail.mailers.smtp.encryption' => $smtpSettings->mail_encryption,
                    'mail.from.address' => $smtpSettings->mail_from,
                    'mail.from.name' => settings('site_name', 'VAIL RESORTS'),
                ]);

                // Purge the mail manager to reload configuration
                app('mail.manager')->purge('smtp');
                
                return true;
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to configure custom SMTP settings: ' . $e->getMessage());
        }
        
        return false;
    }
}
