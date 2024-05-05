<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'page_id',
        'key',
        'textValue',
        'fileValue',
        'imageValue',
        'type',
        'booleanValue',
        'repeaterValue',
        'repeaterType',
        'metaValue'
    ];

    public $casts = [
        'booleanValue' => 'boolean',
        'repeaterValue' => 'array',
        'metaValue' => 'array'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
