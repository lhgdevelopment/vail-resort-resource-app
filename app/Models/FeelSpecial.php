<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeelSpecial extends Model
{
    use HasFactory;

    protected $table = 'feel_special';

    protected $fillable = [
        'title',
        'short_description',
        'images',
        'button_title',
        'button_link',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function ltoBannerSliders()
    {
        return $this->hasMany(LtoBannerSlider::class);
    }
}
