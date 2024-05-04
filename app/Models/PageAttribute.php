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
        'booleanValue'
    ];

    public $casts = [
        'bolValue' => 'boolean'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
