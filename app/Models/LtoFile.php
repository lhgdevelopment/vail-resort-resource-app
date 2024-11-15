<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LtoFile extends Model
{
    use HasFactory;

    protected $fillable = ['lto_id', 'file_name', 'file_path', 'file_type'];

}
