<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'entity_type',
        'entity_id',
        'key',
        'componentValue',
        'textValue',
        'fileValue',
        'type',
        'booleanValue',
        'repeaterValue',
        'keyValue',
        'repeaterType',
        'metaValue'
    ];

    public $casts = [
        'booleanValue' => 'boolean',
        'repeaterValue' => 'array',
        'metaValue' => 'array',
        'keyValue' => 'array'
    ];

    public function page()
    {
        return $this->morphTo();
    }
}
