<?php

namespace App\Models;

use App\Models\Traits\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, HasAttributes;

    protected $fillable = [
        'title',
        'description',
        'type',
        'slug',
        'is_published',
        'meta',
        'attrs'
    ];
}
