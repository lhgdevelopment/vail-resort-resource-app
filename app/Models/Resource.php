<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'category_id',
        'type',
        'file_path',
        'embed_code',
        'tags',
        'status',
        'feature_image'
    ];

    // Define the reverse relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function resourceFiles()
    {
        return $this->hasMany(ResourceFile::class);
    }
}
