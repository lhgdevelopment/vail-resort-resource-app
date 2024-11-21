<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lto extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'from_date', 'to_date', 'description', 'lto_month_id', 'images'];

    protected $casts = [
        'images' => 'array',
    ];

    public function ltoMonth()
    {
        return $this->belongsTo(LtoMonth::class);
    }

    public function files()
    {
        return $this->hasMany(LtoFile::class);
    }

}
