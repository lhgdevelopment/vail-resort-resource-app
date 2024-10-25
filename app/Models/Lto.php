<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lto extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'from_date', 'to_date', 'description'];

}
