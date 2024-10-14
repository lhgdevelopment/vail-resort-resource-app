<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner',
        'thumbnail',
        'is_featured',
        'priority',
        'status',
        'short_description',
        'long_description',
    ];

    // Define the relationship with Resource
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }
}
