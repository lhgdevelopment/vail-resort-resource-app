<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMTPSetting extends Model
{
    use HasFactory;

    protected $table = "smtp_settings";

    protected $fillable = [
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_from',
        'mail_password',
        'mail_encryption',
    ];
}
