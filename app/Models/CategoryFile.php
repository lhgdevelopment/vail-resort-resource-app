<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'resource_type',
        'file_name',
        'file_path',
        'file_type',
        'embed_code',
        'external_link',
        'priority',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
