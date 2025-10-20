<?php

namespace App\Http\Controllers;

use App\Models\SMTPSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SMTPSettingController extends Controller
{
    public function index()
    {
        $settings = SMTPSetting::first();
        return view('backend.settings.smtp', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'mail_host' => 'required',
            'mail_port' => 'required',
            'mail_username' => 'required',
            'mail_from' => 'required',
            'mail_password' => 'required',
            'mail_encryption' => 'required',
        ]);

        $settings = SMTPSetting::first();
        if (!$settings) {
            $settings = new SMTPSetting();
        }

        $settings->mail_host = $request->mail_host;
        $settings->mail_port = $request->mail_port;
        $settings->mail_username = $request->mail_username;
        $settings->mail_from = $request->mail_from;
        $settings->mail_password = $request->mail_password;
        $settings->mail_encryption = $request->mail_encryption;
        $settings->save();

        // Update the .env file
        // $this->updateEnv([
        //     'MAIL_HOST' => $request->mail_host,
        //     'MAIL_PORT' => $request->mail_port,
        //     'MAIL_USERNAME' => $request->mail_username,
        //     'MAIL_PASSWORD' => $request->mail_password,
        //     'MAIL_ENCRYPTION' => $request->mail_encryption,
        //     'MAIL_FROM_ADDRESS' => $request->mail_from,
        // ]);

        return redirect()->route('smtp.index')->with('success', 'SMTP settings updated successfully');
    }

    // Helper function to update the .env file
    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            // Replace existing values or add new ones
            $envContent = preg_replace('/^' . $key . '=.*/m', $key . '=' . $value, $envContent);
        }

        // Save the updated content back to the .env file
        File::put($envPath, $envContent);
    }
}
