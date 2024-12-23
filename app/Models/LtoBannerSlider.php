<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LtoBannerSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'file_name',
        'feel_special_id',
    ];

    public function feelSpecial()
    {
        return $this->belongsTo(FeelSpecial::class);
    }

    
}
