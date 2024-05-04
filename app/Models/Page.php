<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'blade',
        'is_published',
        'meta',
        'attrs'
    ];

    public function pageAttributes()
    {
        return $this->hasMany(PageAttribute::class);
    }
}
