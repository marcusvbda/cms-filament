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
        'attrs',
    ];

    protected $casts = [
        'attrs' => 'array',
    ];

    public function attributeValue($key)
    {
        $attrs = $this->attrs ?? [];
        $result = array_filter($attrs, function ($attr) use ($key) {
            return $attr['key'] === $key;
        });
        return data_get(array_values($result), '0.value');
    }
}
